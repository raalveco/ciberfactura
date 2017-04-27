<?php
    namespace Raalveco\Ciberfactura\Libraries;

    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Str;
    use SWServices\Authentication\AuthenticationService as Authentication;
    use SWServices\Stamp\StampService as StampService;

    class CfdiTimbrador implements CfdiTimbradoInterface{
        private $usuario;
        private $password;
        private $token;

        private $cer;
        private $key;
        private $clave_privada;
        private $rfc;

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

            if($this->endpoint){
                throw new CfdiException("No se ha definido la variable de entorno y/o configuración para el endpoint del PAC Smarter Web.");
            }

            if($this->usuario){
                throw new CfdiException("No se ha definido la variable de entorno y/o configuración para el usuario del PAC Smarter Web.");
            }

            if($this->password){
                throw new CfdiException("No se ha definido la variable de entorno y/o configuración para el password del PAC Smarter Web.");
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

            $url_cer = $certificate["cer"];
            $url_key = $certificate["key"];
            $clave_privada = $certificate["password"];

            $this->cer = base64_encode(file_get_contents($url_cer));
            $this->key = base64_encode(file_get_contents($url_key));
            $this->clave_privada = $clave_privada;
        }

        public function timbrar($xml){
            $params = [
                "url" => $this->endpoint,
                "token" => $this->token
            ];

            try{
                $stamp = StampService::Set($params);

                $result = $stamp::StampV1($xml);

                $result = json_decode($result);

                if($result->status == "success"){
                    $response = $result->data->tfd;

                    $tmp1 = substr($response, strpos($response, 'xsi:schemaLocation="') + 20);
                    $tmp1 = substr($tmp1, 0, strpos($tmp1, '"'));

                    $tmp2 = substr($response, strpos($response, 'xmlns:tfd="') + 11);
                    $tmp2 = substr($tmp2, 0, strpos($tmp2, '"'));

                    $tmp3 = substr($response, strpos($response, 'xmlns:xsi="') + 11);
                    $tmp3 = substr($tmp3, 0, strpos($tmp3, '"'));

                    $timbre = simplexml_load_string($response);

                    $timbre[0]["xsi:schemaLocation"] = str_replace('"', '', $tmp1);
                    $timbre[0]["xmlns:tfd"] = str_replace('"', '', $tmp2);
                    $timbre[0]["xmlns:xsi"] = str_replace('"', '', $tmp3);

                    $this->stamp = CfdiStamp::create([
                        'version' => $timbre[0]["Version"]."",
                        'uuid' => Str::upper($timbre[0]["UUID"].""),
                        'fecha_timbrado' => str_replace("T"," ", $timbre[0]["FechaTimbrado"].""),
                        'rfc' => $timbre[0]["RfcProvCertif"]."",
                        'sello_cfd' => $timbre[0]["SelloCFD"]."",
                        'no_certificado_sat' => $timbre[0]["NoCertificadoSAT"]."",
                        'sello_sat' => $timbre[0]["SelloSAT"].""
                    ]);

                    return $this->stamp;
                }
                else{
                    throw new CfdiException("El Servicio de Timbrado indica un error no identificado.");
                }
            }
            catch(\Exception $e){
                throw new CfdiException($e->getMessage());
            }
        }

        public function cancelar($uuid){
            throw new CfdiException("El Servicio de Cancelación no esta definido.");
            /*
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

                    file_put_contents(public_path()."/cfdis/".strtoupper($this->cfdi->uuid)."_ACUSE_CANCELACION.xml",$response);

                    return $response;
                }
                catch(\Exception $e){
                    throw new CfdiException($e->getMessage());
                }
            */
        }
    }