<?php
    class CfdiCancelacion{
        private $cfdi;
        private $xml;
        private $response;

        public function __construct($cfdi){
            $cfdi = CfdiFactura::consultar($cfdi);

            $contribuyente = $cfdi->emisor();
            $certificado = Certificado::buscar("numero_serie = '$cfdi->no_certificado'");

            $contribuyente_rfc = $contribuyente->rfc;
            $contribuyente_no_certificado = $certificado->numero_serie;
            $contribuyente_clave_privada = $certificado->clave_privada;

            $cer_path = APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer';
            $cer_pem_path = APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer.pem';
            $key_path = APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.key';
            $pem_path = APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.key.pem';
            $pfx_path = APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_rfc.'.pfx';

            $cmd = 'openssl x509 -out '.$cer_pem_path.' -inform DER -outform PEM -in '.$cer_path.'';

            if($cer = shell_exec($cmd)){
                unset( $cmd );
            }

            $cmd = 'openssl pkcs8 -out '.$pem_path.' -in '.$key_path.' -inform DER -passin pass:'.$contribuyente_clave_privada.' -outform PEM';

            if($key = shell_exec($cmd)){
                unset( $cmd );
            }

            $cmd = 'openssl rsa -inform PEM -outform PEM -in '.$pem_path.' -text';

            if($pem = shell_exec($cmd)){
                unset( $cmd );
            }

            $cmd = 'openssl pkcs12 -export -in '.$cer_pem_path.' -inkey '.$pem_path.' -out '.$pfx_path.' -passout pass:'.$contribuyente_clave_privada;

            if($pfx = shell_exec($cmd)){
                unset( $cmd );
            }

            $x = strpos($pem,"modulus:")+9;
            $y = strpos($pem, "publicExponent:") - $x;

            $modulus = substr($pem, $x, $y - 1);

            $modulus = str_replace("\n", "", $modulus);
            $modulus = str_replace("\t", "", $modulus);
            $modulus = str_replace(" ", "", $modulus);

            $x = strpos($pem,"privateExponent:")+17;
            $y = strpos($pem, "prime1:") - $x;

            $private = substr($pem, $x, $y - 1);

            $private = str_replace("\n", "", $private);
            $private = str_replace("\t", "", $private);
            $private = str_replace(" ", "", $private);

            $x = strpos($pem,"prime1:")+8;
            $y = strpos($pem, "prime2:") - $x;

            $prime1 = substr($pem, $x, $y - 1);

            $prime1 = str_replace("\n", "", $prime1);
            $prime1 = str_replace("\t", "", $prime1);
            $prime1 = str_replace(" ", "", $prime1);

            $x = strpos($pem,"prime2:")+8;
            $y = strpos($pem, "exponent1:") - $x;

            $prime2 = substr($pem, $x, $y - 1);

            $prime2 = str_replace("\n", "", $prime2);
            $prime2 = str_replace("\t", "", $prime2);
            $prime2 = str_replace(" ", "", $prime2);

            $x = strpos($pem,"exponent1:")+11;
            $y = strpos($pem, "exponent2:") - $x;

            $exponent1 = substr($pem, $x, $y - 1);

            $exponent1 = str_replace("\n", "", $exponent1);
            $exponent1 = str_replace("\t", "", $exponent1);
            $exponent1 = str_replace(" ", "", $exponent1);

            $x = strpos($pem,"exponent2:")+11;
            $y = strpos($pem, "coefficient:") - $x;

            $exponent2 = substr($pem, $x, $y - 1);

            $exponent2 = str_replace("\n", "", $exponent2);
            $exponent2 = str_replace("\t", "", $exponent2);
            $exponent2 = str_replace(" ", "", $exponent2);

            $x = strpos($pem,"coefficient:")+13;
            $y = strpos($pem, "-----") - $x;

            $coefficient = substr($pem, $x, $y - 1);

            $coefficient = str_replace("\n", "", $coefficient);
            $coefficient = str_replace("\t", "", $coefficient);
            $coefficient = str_replace(" ", "", $coefficient);

            $x = strpos($cer,"-----BEGIN CERTIFICATE-----")+28;
            $y = strpos($cer, "-----END CERTIFICATE-----") - $x;

            $certificado = substr($cer, $x, $y - 1);

            $certificado = str_replace("\n", "", $certificado);
            $certificado = str_replace("\t", "", $certificado);
            $certificado = str_replace(" ", "", $certificado);

            $modulus = CFDICancelacion::SSLDataExtractedToXMLData($modulus, false);
            $public = "AQAB";
            $private = CFDICancelacion::SSLDataExtractedToXMLData($private, false);
            $prime1 = CFDICancelacion::SSLDataExtractedToXMLData($prime1, false);
            $prime2 = CFDICancelacion::SSLDataExtractedToXMLData($prime2, false);
            $exponent1 = CFDICancelacion::SSLDataExtractedToXMLData($exponent1, false);
            $exponent2 = CFDICancelacion::SSLDataExtractedToXMLData($exponent2, false);
            $coefficient = CFDICancelacion::SSLDataExtractedToXMLData($coefficient, false);

            $KeyInXML = base64_encode("<RSAKeyValue><Modulus>".$modulus."</Modulus><Exponent>".$public."</Exponent><P>".$prime1."</P><Q>".$prime2."</Q><DP>".$exponent1."</DP><DQ>".$exponent2."</DQ><InverseQ>".$coefficient."</InverseQ><D>".$private."</D></RSAKeyValue>");

            $cancelacion = new Nodo("Cancelacion");

            $emisor = $cfdi->emisor();

            $cancelacion->agregarAtributo("rfcEmisor", $emisor->rfc);
            $cancelacion->agregarAtributo("certificado", $certificado);
            $cancelacion->agregarAtributo("llaveCertificado", $KeyInXML);

            $folios = new Nodo("Folios");

            $folio = new Nodo("Folio");
            $folio->agregarAtributo("UUID", $cfdi->timbre_uuid);
            $folios->agregarNodo($folio);

            $cancelacion->agregarNodo($folios);

            $this->xml = new DOMDocument('1.0' , 'UTF-8');
            $this->xml->appendChild($this->xmlizar($cancelacion));
            $this->xml->formatOutput = true;
            $xml = $this->xml->saveXML();

            $this->response = WsFacturadorElectronico::cancelacionPFX($contribuyente_rfc, $cfdi->timbre_uuid, $fiel_pfx_path, $contribuyente_clave_privada);

            //print_r($this->response);
            //die();
        }

        public function response(){
            return $this->response;
        }

        public function xmlizar($nodo){
            $xml = $this->xml->createElement($nodo->nombre);

            if($nodo->atributos) foreach($nodo->atributos as $nombre => $valor){
                $tmp = $this->xml->createAttribute($nombre);
                $tmp->value = $valor;
                $xml->appendChild($tmp);
            }

            if($nodo->nodos) foreach($nodo->nodos as $n){
                $tmp = $this->xmlizar($n);
                $xml->appendChild($tmp);
            }

            return $xml;
        }

        public static function hexToStr($hex){
            $string='';
            for ($i=0; $i < strlen($hex)-1; $i+=2){
                $string .= chr(hexdec($hex[$i].$hex[$i+1]));
            }
            return $string;
        }

        public static function SSLDataExtractedToXMLData($SSLData, $JumpFirst = false){

            $ArrVals = explode(":", $SSLData); $a = "";

            if ($JumpFirst){
                $inicio = 1;
            }
            else {
                $inicio = 0;
            }

            $x = "";
            for($i = $inicio; $i < count($ArrVals); $i = $i + 1){
                $a = $a.CFDICancelacion::hexToStr(trim($ArrVals[$i]));
                $x.=trim($ArrVals[$i]);
            }

            return base64_encode($a);
        }
    }