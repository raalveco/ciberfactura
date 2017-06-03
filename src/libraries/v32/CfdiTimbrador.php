<?php
    namespace Raalveco\Ciberfactura\Libraries\V32;

    use Illuminate\Support\Facades\Config;

    class CfdiTimbrador implements CfdiTimbradoInterface{
        private $namespace = 'http://www.ciberfactura.com.mx';

        private $soap_autentificar;
        private $soap_timbrar;
        private $soap_cancelar;

        private $usuario;
        private $password;
        private $token;

        private $cer;
        private $key;
        private $clave_privada;
        private $rfc;

        private $url_autentificar;
        private $url_timbrar;
        private $url_cancelar;

        public function __construct($rfc, $certificate, $production = false){
            try{
                $this->rfc = $rfc;

                if($production){
                    $this->url_autentificar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_production.url_autentificar');
                    $this->url_timbrar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_production.url_timbrar');
                    $this->url_cancelar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_production.url_cancelar');

                    $this->usuario = Config::get('packages.raalveco.ciberfactura.config.v32.sw_production.usuario');
                    $this->password = Config::get('packages.raalveco.ciberfactura.config.v32.sw_production.password');
                }
                else{
                    $this->url_autentificar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_test.url_autentificar');
                    $this->url_timbrar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_test.url_timbrar');
                    $this->url_cancelar = Config::get('packages.raalveco.ciberfactura.config.v32.sw_test.url_cancelar');

                    $this->usuario = Config::get('packages.raalveco.ciberfactura.config.v32.sw_test.usuario');
                    $this->password = Config::get('packages.raalveco.ciberfactura.config.v32.sw_test.password');
                }

                if(empty($certificate)){
                    $url_cer = str_replace("\\","/", base_path())."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages.raalveco.ciberfactura.config.cer');
                    $url_key = str_replace("\\","/", base_path())."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages.raalveco.ciberfactura.config.key');
                    $clave_privada = Config::get('packages.raalveco.ciberfactura.config.clave_privada');
                }
                else{
                    $url_cer = $certificate["cer"];
                    $url_key = $certificate["key"];
                    $clave_privada = $certificate["password"];
                }

                $this->soap_autentificar = new \SoapClient($this->url_autentificar, array("trace" => 1, "exception" => 0));
                $this->soap_timbrar = new \SoapClient($this->url_timbrar, array("trace" => 1, "exception" => 0));
                $this->soap_cancelar = new \SoapClient($this->url_cancelar, array("trace" => 1, "exception" => 0));

                $this->cer = base64_encode(file_get_contents($url_cer));
                $this->key = base64_encode(file_get_contents($url_key));
                $this->clave_privada = $clave_privada;

                $token = $this->soap_autentificar->AutenticarBasico(array("usuario" => $this->usuario, "password" => $this->password));

                $this->token = $token->AutenticarBasicoResult;
            }
            catch(\Exception $e){
                throw new CfdiException($e->getMessage());
            }
        }

        public function timbrar($xml){
            try{
                $parametros = array(
                    'xmlComprobante' => $xml,
                    'tokenAutenticacion' => $this->token,
                    'password' => $this->password
                );

                $response = $this->soap_timbrar->TimbrarXML($parametros);

                return $response;
            }
            catch(\Exception $e){
                throw new CfdiException($e->getMessage());
            }
        }

        public function cancelar($uuid){
            try{
                if(!is_array($uuid)){
                    $uuid = array($uuid);
                }

                $parametros = array(
                    'CSDCer' => $this->cer,
                    'CSDKey' => $this->key,
                    'password' => $this->clave_privada,
                    'RFCEmisor' => $this->rfc,
                    'UUIDs' => $uuid,
                    'tokenAutenticacion' => $this->token
                );

                $response = $this->soap_cancelar->cancelarCSD($parametros)->CancelarCSDResult;

                return $response;
            }
            catch(\Exception $e){
                throw new CfdiException($e->getMessage());
            }
        }
    }