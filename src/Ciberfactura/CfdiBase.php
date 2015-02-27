<?php
namespace Ciberfactura;

class CfdiBase {

    public static function sealXML($archivo_key, $archivo_cer, $cadena_original){
        $numero_certificado = CfdiBase::getSerialFromCertificate( $archivo_cer );
        $content = file_get_contents($archivo_key);
        $content =  '-----BEGIN CERTIFICATE-----'.PHP_EOL.chunk_split(base64_encode($content), 64, PHP_EOL).'-----END CERTIFICATE-----'.PHP_EOL;
        $archivo_pem = $archivo_key.'.pem';
        file_put_contents($archivo_pem, $content);
        $private = openssl_pkey_get_private(file_get_contents($archivo_key));
        openssl_sign($cadena_original, $firma, $private);
        $sello = base64_encode($firma);
        echo "SELLO: ".$sello."<br><br>";
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

        $xslt = new XSLTProcessor();
        $xsl = new DOMDocument();
        $xml = new DOMDocument();

        $xsl->load( $xsltFile, LIBXML_NOCDATA);
        $xml->load( $xmlFile, LIBXML_NOCDATA );

        @$xslt->importStylesheet( $xsl );

        return $xslt->transformToXML( $xml );

    }
}
