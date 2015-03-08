<?php
namespace Ciberfactura;

use Illuminate\Support\Facades\Config;

class CfdiBase {
    public $xml;
    public $cadenaOriginal;
    public $sello;
    public $key;
    public $certificado;
    public $noCertificado;
    public $tmp_file;
    public $cfdi;

    protected $version = "3.2";

    public function __construct(CfdiFactura $cfdi){
        if(Config::get('packages/raalveco/ciberfactura/config.production')){
            $url_cer = app_path()."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages/raalveco/ciberfactura/config.cer');
            $url_key = app_path()."/config/packages/raalveco/ciberfactura/certificados/".Config::get('packages/raalveco/ciberfactura/config.key');
            $clave_privada = Config::get('packages/raalveco/ciberfactura/config.clave_privada');
        }
        else{
            $url_cer = app_path()."/config/packages/raalveco/ciberfactura/certificados/test/aad990814bp7_1210261233s.cer";
            $url_key = app_path()."/config/packages/raalveco/ciberfactura/certificados/test/aad990814bp7_1210261233s.key";
            $clave_privada = "12345678a";
        }

        if(!file_exists(public_path()."/cfdis")){
            mkdir(public_path()."/cfdis");
        }

        $this->noCertificado = CfdiBase::getSerialFromCertificate( $url_cer );
        $this->certificado = CfdiBase::getCertificate( $url_cer, false );
        $this->key = CfdiBase::getPrivateKey($url_key, $clave_privada);

        $this->cfdi = $cfdi;

        $this->xml = new CfdiGenerator($this->cfdi);

        if(!file_exists(public_path()."/temp")){
            mkdir(public_path()."/temp");
        }

        $this->tmp_file = public_path()."/temp/".sha1(date("Y-m-d H:i:s".rand(0,100000))).".xml";
        $this->xml->saveFile($this->tmp_file, false);

        $this->cadenaOriginal = CfdiBase::getOriginalString($this->tmp_file, app_path().'/config/packages/raalveco/ciberfactura/cadenaoriginal_3_2.xslt');

        $this->cfdi->noCertificado = $this->noCertificado;
        $this->cfdi->certificado = $this->certificado;
        $this->cfdi->save();
    }

    public function xml(){
        return $this->xml->getXML();
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
        echo $cmd;
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

    public static function signData ( $key, $data ){
        $pkeyid = openssl_get_privatekey( $key );
        $data = "|".substr($data,3);
        $data = substr($data,0,strlen($data)-4)."||";
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

    public static function getOriginalString($xml_pad, $xlst_path){
        $xsltFile = $xlst_path;
        $xmlFile = $xml_pad;

        $xslt = new \XSLTProcessor();
        $xsl = new \DOMDocument();
        $xml = new \DOMDocument();

        $xsl->load( $xsltFile, LIBXML_NOCDATA);
        $xml->load( $xmlFile, LIBXML_NOCDATA );

        @$xslt->importStylesheet( $xsl );

        return $xslt->transformToXML( $xml );

    }
}
