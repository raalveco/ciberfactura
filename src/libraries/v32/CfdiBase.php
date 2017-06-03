<?php
namespace Raalveco\Ciberfactura\Libraries\V32;

use Illuminate\Support\Facades\Config;
use Raalveco\Ciberfactura\Models\V32\CfdiComplemento;
use Raalveco\Ciberfactura\Models\V32\CfdiConcepto;
use Raalveco\Ciberfactura\Models\V32\CfdiFactura;

class CfdiBase {
    public $xml;
    public $cadenaOriginal;
    public $sello;
    public $key;
    public $certificado;
    public $noCertificado;
    public $tmp_file;
    public $cfdi;
    public $rfc;
    public $production;

    protected $version = "3.2";

    public function __construct(CfdiFactura $cfdi, $certificate = array(), $production = false){
        $this->certificate = $certificate;
        $this->production = $production;

        $nomina = false;
        if(isset($cfdi->nomina) && $cfdi->nomina){
            unset($cfdi->nomina);
            $nomina = true;
        }

        if(empty($certificate)){
            $url_cer = str_replace("\\","/", base_path())."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages.raalveco.ciberfactura.config.cer');
            $url_key = str_replace("\\","/", base_path())."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages.raalveco.ciberfactura.config.key');
            $clave_privada = Config::get('packages.raalveco.ciberfactura.config.clave_privada');

            $this->noCertificado = CfdiBase::getSerialFromCertificate( $url_cer );
        }
        else{
            $url_cer = $certificate["cer"];
            $url_key = $certificate["key"];
            $clave_privada = $certificate["password"];

            $this->noCertificado = $certificate["serial_number"];
        }

        $this->certificado = CfdiBase::getCertificate( $url_cer, false );
        $this->key = CfdiBase::getPrivateKey($url_key, $clave_privada);

        $this->cfdi = $cfdi;
        $this->rfc = $cfdi->emisor->rfc;

        $this->cfdi->no_certificado = $this->noCertificado;
        $this->cfdi->certificado = $this->certificado;

        if(CfdiComplemento::where("cfdi_id", $cfdi->id)->count() == 0){
            if(!file_exists(public_path()."/cfdis")){
                mkdir(public_path()."/cfdis");
            }

            if($nomina){
                $this->xml = new CfdiGenerator($this->cfdi, $nomina);
            }
            else{
                $this->xml = new CfdiGenerator($this->cfdi);
            }

            if(!file_exists(public_path()."/temp")){
                mkdir(public_path()."/temp");
            }

            $this->tmp_file = public_path()."/temp/".strtoupper(sha1(date("Y-m-d H:i:s".rand(0,100000)))).".xml";
            $this->xml->saveFile($this->tmp_file, false);
        }

        if($this->cfdi->cadena_original){
            $this->cadenaOriginal = $this->cfdi->cadena_original;
        }
        else{
            $this->cadenaOriginal = $this->generateOriginalString();
            $this->cfdi->cadena_original = trim(str_replace("\n","",  str_replace("\r","",  $this->cadenaOriginal)));
        }

        $this->cfdi->save();
    }

    public static function validateXML($xml_path){
        try {
            $reader = new \Sabre\Xml\Reader();
            $reader->xml(file_get_contents($xml_path));
            $xml = $reader->parse();

            $attributes = $xml["attributes"];

            if(isset($attributes["certificado"])){
                $cadena = CfdiBase::getOriginalString($xml_path, base_path().'/config/packages/raalveco/ciberfactura/xslt/cadenaoriginal_3_2.xslt');

                $pem = $attributes["certificado"];

                $pem = preg_replace('/\s\s+/', '', $pem);

                if (strlen($pem) == 0) {
                    $pem=""; $der="";
                    $p1=substr($attributes["noCertificado"],0,6);
                    $p2=substr($attributes["noCertificado"],6,6);
                    $p3=substr($attributes["noCertificado"],12,2);
                    $p4=substr($attributes["noCertificado"],14,2);
                    $p5=substr($attributes["noCertificado"],16,2);

                    $cer_path = "https://rdc.sat.gob.mx/rccf/$p1/$p2/$p3/$p4/$p5/".$attributes["noCertificado"].".cer";

                    $done = false;
                    $x = 0;

                    while ( ! $done ){
                        $path = $cer_path;

                        $der = file_get_contents("$path");

                        if ($der){
                            $done = true;
                        } else {
                            usleep (100000);
                        }

                        if ( $x == 5 ) $done = true;

                        $x++;
                    }

                    $pem = base64_encode($der);
                }
            }

            $cert = "-----BEGIN CERTIFICATE-----\n".chunk_split($pem,64)."-----END CERTIFICATE-----\n";

            $pubkeyid = openssl_get_publickey(openssl_x509_read($cert));

            $validation = openssl_verify($cadena, base64_decode($attributes["sello"]), $pubkeyid, OPENSSL_ALGO_SHA1);

            return $validation;
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function xml(){
        $cfdi_id = $this->cfdi->id;
        if(CfdiComplemento::whereRaw("cfdi_id = $cfdi_id")->count() == 0){
            return $this->xml->getXML();
        }
        else{
            return file_get_contents(public_path()."/cfdis/".strtoupper($this->cfdi->uuid()).".xml");
        }
    }

    public function uuid(){
        return $this->cfdi->uuid();
    }

    public static function sealXML($archivo_key, $archivo_cer, $cadena_original){
        $numero_certificado = CfdiBase::getSerialFromCertificate( $archivo_cer );
        $content = file_get_contents($archivo_key);
        $content =  '-----BEGIN CERTIFICATE-----'.PHP_EOL.chunk_split(base64_encode($content), 64, PHP_EOL).'-----END CERTIFICATE-----'.PHP_EOL;
        $archivo_pem = $archivo_key.'.pem';
        file_put_contents($archivo_pem, $content);
        $private = openssl_pkey_get_private(file_get_contents($archivo_key));
        openssl_sign($cadena_original, $firma, $private);
        $sello = base64_encode($firma);
        return $sello;
    }

    public static function sealing($key_path, $cer_path, $cadena){
        $cmd = "openssl dgst sign [".$key_path."] [".sha1($cadena)."] | openssl enc -base64 -A  [".$cer_path."]";
        if ( $result = shell_exec( $cmd ) ) {
            unset( $cmd );
            return $result;
        }
        return false;
    }

    public static function getPrivateKey ( $key_path, $password ){
        $cmd = 'openssl pkcs8 -inform DER -in '.$key_path.' -passin pass:'.$password;
        if ( $result = shell_exec( $cmd ) ) {
            unset( $cmd );
            return $result;
        }
        return false;
    }

    public static function getCertificate ( $cer_path, $to_string = true ){
        $cmd = 'openssl x509 -inform DER -outform PEM -in '.$cer_path.' -pubkey';
        if ( $result = shell_exec( $cmd ) ) {
            unset( $cmd );
            if ( $to_string ) {
                return $result;
            }
            $split = preg_split( '/\n(-*(BEGIN|END)\sCERTIFICATE-*\n)/', $result );
            unset( $result );
            return preg_replace( '/\n/', '', $split[1] );
        }
        return false;
    }

    public static function getInfoCertificate ( $cer_path, $to_string = true ){
        $cer_path = str_replace("\\","/", $cer_path);

        echo $cer_path."<br>";

        if(!file_exists($cer_path)){
            $response = [
                "rfc" => "",
                "serial" => "",
                "start_date" => "0000-00-00",
                "end_date" => "0000-00-00"
            ];

            return $response;
        }

        $cmd = 'openssl x509 -inform DER -in '.$cer_path.' -serial -dates -subject';

        $result = shell_exec( $cmd );

        $result = explode("\n", $result);

        $serial = ""; $notBefore = ""; $notAfter = ""; $rfc = "";

        for($i = 0; $i < count($result); $i++){
            $line = $result[$i];

            if(strpos($line, "serial") !== false && $serial == ""){
                $serial = str_replace("serial=", "", $line);

                $serial_number = "";

                for($k = 1; $k < strlen($serial); $k += 2){
                    $serial_number .= $serial[$k];
                }
            }

            if(strpos($line, "notBefore") !== false){
                $notBefore = str_replace("notBefore=", "", $line);
            }

            if(strpos($line, "notAfter") !== false){
                $notAfter = str_replace("notAfter=", "", $line);
            }

            if(strpos($line, "subject") !== false){
                $line = substr($line, strpos($line, "UniqueIdentifier=") + 17);

                $rfc = trim(substr($line, 0, strpos($line, "/")));
            }

            if($serial != "" && $notBefore != "" && $notAfter != "" && $rfc != ""){
                break;
            }
        }

        $notBefore = str_replace("    "," ", $notBefore);
        $notBefore = str_replace("   "," ", $notBefore);
        $notBefore = str_replace("  "," ", $notBefore);

        $notBefore = explode(" ", $notBefore);

        $d1 = str_pad($notBefore[1],2,"0", STR_PAD_LEFT);
        $m1 = 1;
        $y1 = str_pad($notBefore[3],4,"0", STR_PAD_LEFT);;

        switch($notBefore[0]){
            case "Jan": $m1 = 1; break;
            case "Feb": $m1 = 2; break;
            case "Mar": $m1 = 3; break;
            case "Apr": $m1 = 4; break;
            case "May": $m1 = 5; break;
            case "Jun": $m1 = 6; break;
            case "Jul": $m1 = 7; break;
            case "Aug": $m1 = 8; break;
            case "Sep": $m1 = 9; break;
            case "Oct": $m1 = 10; break;
            case "Nov": $m1 = 11; break;
            case "Dec": $m1 = 12; break;
        }

        $m1 = str_pad($m1,2,"0", STR_PAD_LEFT);

        $notAfter = str_replace("    "," ", $notAfter);
        $notAfter = str_replace("   "," ", $notAfter);
        $notAfter = str_replace("  "," ", $notAfter);

        $notAfter = explode(" ", $notAfter);

        $d2 = str_pad($notAfter[1],2,"0", STR_PAD_LEFT);;
        $m2 = 1;
        $y2 = str_pad($notAfter[3],4,"0", STR_PAD_LEFT);;

        switch($notAfter[0]){
            case "Jan": $m2 = 1; break;
            case "Feb": $m2 = 2; break;
            case "Mar": $m2 = 3; break;
            case "Apr": $m2 = 4; break;
            case "May": $m2 = 5; break;
            case "Jun": $m2 = 6; break;
            case "Jul": $m2 = 7; break;
            case "Aug": $m2 = 8; break;
            case "Sep": $m2 = 9; break;
            case "Oct": $m2 = 10; break;
            case "Nov": $m2 = 11; break;
            case "Dec": $m2 = 12; break;
        }

        $m2 = str_pad($m2,2,"0", STR_PAD_LEFT);

        $response = [
            "rfc" => $rfc,
            "serial" => $serial_number,
            "start_date" => $y1."-".$m1."-".$d1,
            "end_date" => $y2."-".$m2."-".$d2
        ];

        return $response;
    }

    public static function signData ( $key, $data ){
        $pkeyid = openssl_get_privatekey( $key );
        //$data = "|".substr($data,3);
        //$data = substr($data,0,strlen($data)-4)."||";

        if ( openssl_sign( $data, $cryptedata, $pkeyid,OPENSSL_ALGO_SHA1 ) ) {
            openssl_free_key( $pkeyid );
            return base64_encode( $cryptedata );
        }
    }

    public static function getSerialFromCertificate ( $cer_path ){
        $cmd = 'openssl x509 -inform DER -outform PEM -in '.$cer_path.' -pubkey | '.'openssl x509 -serial -noout';

        if ( $serial = shell_exec( $cmd ) ) {
            unset( $cmd );
            if ( preg_match( "/([0-9]{40})/", $serial, $match ) ) {
                unset( $serial );
                return implode( '', array_map( 'chr', array_map( 'hexdec', str_split( $match[1], 2 ) ) ) );
            }
        }

        return false;
    }

    public static function getOriginalString($xml_path, $xlst_path){
        $xslt = new \XSLTProcessor();
        $xsl = new \DOMDocument();
        $xml = new \DOMDocument();

        $xsl->load( $xlst_path, LIBXML_NOCDATA);
        $xml->load( $xml_path, LIBXML_NOCDATA );

        $xslt->importStylesheet( $xsl );

        $original_string = $xslt->transformToXML( $xml );
        $original_string = str_replace("\n","",$original_string);
        $original_string = str_replace("    ","",$original_string);

        return $original_string;

    }

    public function addPayroll($payroll){
        $this->xml->addPayroll($payroll);

        $this->generateOriginalString();
    }

    public function generateOriginalString(){
        $this->xml->saveFile($this->tmp_file, false);

        if(CfdiComplemento::whereRaw("cfdi_id = ".$this->cfdi->id)->count() == 0){
            $this->cadenaOriginal = CfdiBase::getOriginalString($this->tmp_file, base_path().'/config/packages/raalveco/ciberfactura/xslt/cadenaoriginal_3_2.xslt');
        }
        else{
            $xml_file = public_path()."/cfdis/".strtoupper($this->cfdi->uuid()).".xml";

            $this->cadenaOriginal = CfdiBase::getOriginalString($xml_file, base_path().'/config/packages/raalveco/ciberfactura/xslt/cadenaoriginal_3_2.xslt');
        }

        $this->cfdi->cadena_original = $this->cadenaOriginal;
        $this->cfdi->save();

        return $this->cadenaOriginal;

    }
}
