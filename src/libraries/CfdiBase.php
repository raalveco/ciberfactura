<?php
namespace Raalveco\Ciberfactura\Libraries;

use Genkgo\Xsl\XsltProcessor;
use Illuminate\Support\Facades\Config;
use Raalveco\Ciberfactura\Models\CfdiComplemento;
use Raalveco\Ciberfactura\Models\CfdiFactura;
use Raalveco\Ciberfactura\Models\CfdiTimbre;

class CfdiBase {
    public $xml;
    public $cadena_original;
    public $sello;
    public $key;
    public $certificado;
    public $no_certificado;
    public $tmp_file;
    public $cfdi;
    public $rfc;
    public $production = false;
    public $certificate = array();

    public $timbrador;
    
    public $path = false;

    protected $version = "3.3";

    public function __construct(){
        $this->production = Config::get('packages.raalveco.ciberfactura.config.production');
        $this->path = Config::get('packages.raalveco.ciberfactura.config.path');

        if(!$this->production){
            $url_cer = str_replace("\\","/", base_path()."/".Config::get('packages.raalveco.ciberfactura.config.certificate.sandbox.cer'));
            $url_key = str_replace("\\","/", base_path()."/".Config::get('packages.raalveco.ciberfactura.config.certificate.sandbox.key'));
            $clave_privada = Config::get('packages.raalveco.ciberfactura.config.certificate.sandbox.password');
        }
        else{
            $url_cer = str_replace("\\","/", base_path()."/".Config::get('packages.raalveco.ciberfactura.config.certificate.production.cer'));
            $url_key = str_replace("\\","/", base_path()."/".Config::get('packages.raalveco.ciberfactura.config.certificate.production.key'));
            $clave_privada = Config::get('packages.raalveco.ciberfactura.config.certificate.production.password');
        }

        if(!$url_cer || !$url_key || !$clave_privada){
            throw new CfdiException("La configuración del certificado de sello digital no ha sido definida.");
        }

        if(!file_exists($url_cer) || !is_file($url_cer)){
            throw new CfdiException("El archivo (.cer) del Certificado de Sello Digital no fue encontrado. [$url_cer]");
        }

        if(!file_exists($url_key) || !is_file($url_key)){
            throw new CfdiException("El archivo (.key) del Certificado de Sello Digital no fue encontrado. [$url_key]");
        }

        $this->certificate = array(
            'cer' => $url_cer,
            'key' => $url_key,
            'password' => $clave_privada
        );

        $certificate_number = CfdiBase::getSerialFromCertificate( $url_cer );

        dd($certificate_number);

        if(!$certificate_number){
            throw new CfdiException("El Certificado de Sello Digital no es correcto.");
        }

        $this->no_certificado = $certificate_number;

        $certificate = CfdiBase::getCertificate( $url_cer, false );

        if(!$certificate){
            throw new CfdiException("El Certificado de Sello Digital (.cer) no es correcto.");
        }

        $this->certificado = $certificate;

        $key = CfdiBase::getPrivateKey($url_key, $clave_privada);

        if(!$key){
            throw new CfdiException("El Certificado de Sello Digital (.key) no es correcto o la contraseña es inválida.");
        }

        $this->key = $key;
    }

    public function setTimbrador($timbrador){
        if(!is_object($timbrador)){
            throw new CfdiException("El timbrador tiene que ser un objeto que implementa la interface Raalveco\\Ciberfactura\\Libraries\\CfdiTimbradoInterface.");
        }

        $implements = class_implements($timbrador);

        if($implements){
            $flag = false;

            foreach($implements as $key => $value){
                if($key == 'Raalveco\\Ciberfactura\\Libraries\\CfdiTimbradoInterface' || $value == 'Raalveco\\Ciberfactura\\Libraries\\CfdiTimbradoInterface'){
                    $flag = true;
                }
            }

            if(!$flag){
                throw new CfdiException("El timbrador tiene que ser un objeto que implementa la interface Raalveco\\Ciberfactura\\Libraries\\CfdiTimbradoInterface.");
            }
        }
        else{
            throw new CfdiException("El timbrador tiene que ser un objeto que implementa la interface Raalveco\\Ciberfactura\\Libraries\\CfdiTimbradoInterface.");
        }

        $this->timbrador = $timbrador;
    }

    public function validate(CfdiFactura $cfdi){
        if(!$cfdi->emisor){
            throw new CfdiException("El emisor de la factura (Cfdi) no ha sido definido.");
        }

        if(!$cfdi->receptor){
            throw new CfdiException("El receptor de la factura (Cfdi) no ha sido definido.");
        }

        $conceptos = $cfdi->conceptos()->count();

        if($conceptos == 0){
            throw new CfdiException("La factura (Cfdi) debe contener al menos un concepto a facturar.");
        }
    }

    public function load(CfdiFactura $cfdi){
        $this->validate($cfdi);

        if(!$this->path){
            $this->path = public_path()."/cfdis";
        }

        $this->cfdi = $cfdi;
        $this->rfc = $cfdi->emisor->rfc;

        $this->cfdi->no_certificado = $this->no_certificado;
        $this->cfdi->certificado = $this->certificado;

        $xslt = __DIR__.'/../resources/xslt/cadenaoriginal_3_3.xslt';

        if(!file_exists($xslt)){
            throw new CfdiException("El archivo xslt para necesario para formar la cadena original de la factura no existe en la ruta definida. [$xslt]");
        }

        if($cfdi->timbre){
            $xml_file = $this->path."/".strtoupper($cfdi->uuid).".xml";
            $this->cadenaOriginal = CfdiBase::getOriginalString($xml_file, $xslt);
        }
        else{
            if(!file_exists(Config::get('packages.raalveco.ciberfactura.config.path'))){
                mkdir(Config::get('packages.raalveco.ciberfactura.config.path'));
            }

            $this->xml = new CfdiGenerator($this->cfdi);

            if(!file_exists(public_path()."/temp")){
                mkdir(public_path()."/temp");
            }

            $this->tmp_file = public_path()."/temp/".strtoupper(sha1(date("Y-m-d H:i:s".rand(0,100000)))).".xml";
            $this->xml->saveFile($this->tmp_file, false);

            $this->cadena_original = CfdiBase::getOriginalString($this->tmp_file, $xslt);
        }

        $this->cfdi->cadena_original = trim(str_replace("\n","",  str_replace("\r","",  $this->cadena_original)));
        $this->cfdi->save();
    }

    public function xml(){
        $cfdi_id = $this->cfdi->id;
        if(CfdiTimbre::where("cfdi_id", $cfdi_id)->count() == 0){
            return $this->xml->getXML();
        }
        else{
            return file_get_contents($this->path."/".strtoupper($this->cfdi->uuid).".xml");
        }
    }

    public function uuid(){
        return $this->cfdi->uuid();
    }

    public static function sealXML($archivo_key, $archivo_cer, $cadena_original){
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
        $cmd = "openssl pkcs8 -inform DER -in ".$key_path." -passin pass:'".$password."'";
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

        if(!file_exists($cer_path)){
            $response = [
                "rfc" => "",
                "serial" => "",
                "start_date" => "0000-00-00",
                "end_date" => "0000-00-00",
                "type" => "CSD"
            ];

            return $response;
        }

        $cmd = 'openssl x509 -inform DER -in '.$cer_path.' -serial -dates -subject';

        $result = shell_exec( $cmd );

        $result = explode("\n", $result);

        $type = "CSD";

        foreach($result as $line){
            if(strpos($line, 'subject') === 0){
                if(strpos($line, "OU=") !== false){
                    $type = "CSD";
                }
                else{
                    $type = "FIEL";
                }

                break;
            }
        }

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
            "end_date" => $y2."-".$m2."-".$d2,
            "type" => $type
        ];

        return $response;
    }

    public static function signData ( $key, $data ){
        $pkeyid = openssl_get_privatekey( $key );
        //$data = "|".substr($data,3);
        //$data = substr($data,0,strlen($data)-4)."||";

        if ( openssl_sign( $data, $cryptedata, $pkeyid, OPENSSL_ALGO_SHA256 ) ) {
            openssl_free_key( $pkeyid );
            return base64_encode( $cryptedata );
        }
    }

    public static function getSerialFromCertificate ( $cer_path ){
        $cmd = 'openssl x509 -inform DER -outform PEM -in '.$cer_path.' -pubkey | '.'openssl x509 -serial -noout';

        dd($cmd);

        if ( $serial = shell_exec( $cmd ) ) {
            dd($serial);

            unset( $cmd );
            if ( preg_match( "/([0-9]{40})/", $serial, $match ) ) {
                unset( $serial );
                return implode( '', array_map( 'chr', array_map( 'hexdec', str_split( $match[1], 2 ) ) ) );
            }
        }

        return false;
    }

    public static function getOriginalString($xml_path, $xlst_path){
        $xslt = new XsltProcessor();
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

    public function setProduction($production){
        $this->production = $production;
    }

    public function setPath($path = false){
        if(!$path){
            $path = public_path()."/cfdis";
        }

        $this->path = $path;
    }
}
