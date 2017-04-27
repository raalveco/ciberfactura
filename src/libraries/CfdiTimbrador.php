<?php
    namespace Raalveco\Ciberfactura\Libraries;

    use Illuminate\Support\Facades\Config;
    use SWServices\Authentication\AuthenticationService as Authentication;
    use SWServices\Stamp\StampService as StampService;

    class CfdiTimbrador implements CfdiTimbradoInterface{
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
            if($production){
                $this->endpoint = Config::get('packages.raalveco.ciberfactura.config.wsdl.production.endpoint');

                $this->usuario = Config::get('packages.raalveco.ciberfactura.config.wsdl.production.usuario');
                $this->password = Config::get('packages.raalveco.ciberfactura.config.wsdl.production.password');
            }
            else{
                $this->endpoint = Config::get('packages.raalveco.ciberfactura.config.wsdl.sandbox.endpoint');
                $this->usuario = Config::get('packages.raalveco.ciberfactura.config.wsdl.sandbox.usuario');
                $this->password = Config::get('packages.raalveco.ciberfactura.config.wsdl.sandbox.password');
            }

            $this->rfc = $rfc;

            $params = [
                "url" => $this->endpoint,
                "user" => $this->usuario,
                "password"=> $this->password
            ];

            try{

                $auth = Authentication::auth($params);

                $token = json_decode($auth::Token())->data->token;

                $this->token = $token;

            }
            catch(\Exception $e){
                throw new CfdiException($e->getMessage());
            }

            if(!$this->endpoint){
                throw new CfdiException("Las rutas de los wsdl de conexión con el PAC de timbrado no son válidos.");
            }

            $url_cer = $certificate["cer"];
            $url_key = $certificate["key"];
            $clave_privada = $certificate["password"];

            $this->cer = base64_encode(file_get_contents($url_cer));
            $this->key = base64_encode(file_get_contents($url_key));
            $this->clave_privada = $clave_privada;
        }

        public function timbrar($xml){
            //echo $xml; dd();

            $params = [
                "url" => $this->endpoint,
                "token" => $this->token
            ];

            try{
                $stamp = StampService::Set($params);

                $result = $stamp::StampV1($xml);

                dd($result.$xml);
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