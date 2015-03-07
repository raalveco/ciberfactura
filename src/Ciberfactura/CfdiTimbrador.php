<?php
    namespace Ciberfactura;

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

        public function __construct(){
            if(Config::get('packages/raalveco/ciberfactura/config.production')){
                $url_autentificar = Config::get('packages/raalveco/ciberfactura/pac.url_autentificar');
                $url_timbrar = Config::get('packages/raalveco/ciberfactura/pac.url_timbrar');
                $url_cancelar = Config::get('packages/raalveco/ciberfactura/pac.url_cancelar');

                $this->usuario = Config::get('packages/raalveco/ciberfactura/pac.usuario');
                $this->password = Config::get('packages/raalveco/ciberfactura/pac.password');
                $this->rfc = Config::get('packages/raalveco/ciberfactura/pac.rfc');

                $url_cer = app_path()."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages/raalveco/ciberfactura/config.cer');
                $url_key = app_path()."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages/raalveco/ciberfactura/config.key');
                $clave_privada = Config::get('packages/raalveco/ciberfactura/config.clave_privada');

            }
            else{
                $url_autentificar = "http://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl";
                $url_timbrar = "http://pruebascfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl";
                $url_cancelar = "http://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl";

                $this->usuario = "demo";
                $this->password = "123456789";
                $this->rfc = 'AAD990814BP7';

                $url_cer = app_path()."/config/packages/raalveco/ciberfactura/certificados/test/aad990814bp7_1210261233s.cer";
                $url_key = app_path()."/config/packages/raalveco/ciberfactura/certificados/test/aad990814bp7_1210261233s.key";
                $clave_privada = "12345678a";
            }

            echo $url_autentificar."<br>";

            $this->soap_autentificar = new \nusoap_client($url_autentificar,'soap');
            $this->soap_autentificar->soap_defencoding = "UTF-8";
            $this->soap_autentificar->decode_utf8 = false;

            $this->soap_timbrar = new \nusoap_client($url_timbrar,'soap');
            $this->soap_timbrar->soap_defencoding = "UTF-8";
            $this->soap_timbrar->decode_utf8 = false;

            $this->soap_cancelar = new \nusoap_client($url_cancelar,'soap');
            $this->soap_cancelar->soap_defencoding = "UTF-8";
            $this->soap_cancelar->decode_utf8 = false;

            $this->cer = base64_encode(file_get_contents($url_cer));
            $this->key = base64_encode(file_get_contents($url_key));
            $this->$clave_privada = $clave_privada;

            $parametros = array(
                'request' => array(
                                'usuario' => $this->usuario,
                                'password' => $this->password
                )
            );

            echo "<br><br>";
            print_r($parametros); echo "<br><br>";
            print_r($this->soap_autentificar); echo "<br><br>";

            $this->token = $this->soap_autentificar->call('AutenticarBasico', $parametros, $this->$namespace);
        }

        public function timbrar($xml){
            $parametros = array(
                'xmlComprobante' => $xml,
                'tokenAutenticacion' => $this->token,
                'password' => $this->password
            );

            $response = $this->soap_timbrar->call('TimbrarXML', $parametros, $this->$namespace);

            return $response;
        }

        public function cancelar($uuid){
            $parametros = array(
                'CSDCer' => $this->cer,
                'CSDKey' => $this->key,
                'password' => $this->clave_privada,
                'RFCEmisor' => $this->rfc,
                'UUIDs' => array($uuid),
                'tokenAutenticacion' => $this->token
            );

            $response = $this->soap_timbrar->call('TimbrarXML', $parametros, $this->$namespace);

            return $response;
        }
    }