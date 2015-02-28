<?php
namespace Ciberfactura;

use CfdiComplemento;
use CfdiConcepto;
use CfdiEmisor;
use CfdiFactura;
use CfdiImpuesto;
use CfdiReceptor;
use CfdiRegimen;
use CfdiSucursal;

use Illuminate\Support\Facades\Config;

class Cfdi{
    public $xml;
    public $cadenaOriginal;
    public $sello;
    public $certificado;
    public $noCertificado;
    private $tmp_file;
    private $cfdi;

    protected $version = "3.2";

    public function __construct(){
        $url_cer = app_path()."/config/packages/raalveco/ciberfactura/".Config::get('packages/raalveco/ciberfactura/config.cer');

        $this->noCertificado = CfdiBase::getSerialFromCertificate( $url_cer );
        $this->certificado = CfdiBase::getCertificate( $url_cer, false );
    }

    public function loadCfdi($cfdi){
        $this->cfdi = $cfdi;

        $this->xml = new CfdiGenerator($this->cfdi);

        if(!file_exists(public_path()."/temp")){
            mkdir(public_path()."/temp");
        }

        $this->tmp_file = public_path()."/temp/".sha1(date("Y-m-d H:i:s".rand(0,100000))).".xml";
        $this->xml->saveFile($this->tmp_file);

        $this->cadenaOriginal = CfdiBase::getOriginalString($this->tmp_file, app_path().'/config/packages/raalveco/ciberfactura/cadenaoriginal_3_2.xslt');
    }

    public function sellar2(){
        $contribuyente = $this->cfdi->emisor();
        $certificado = Certificado::buscar("numero_serie = '$this->cfdi->no_certificado'");

        $contribuyente_rfc = $contribuyente->rfc;
        $contribuyente_no_certificado = $certificado->numero_serie;
        $contribuyente_clave_privada = $certificado->clave_privada;

        $noCertificado = SimpleCFDI::getSerialFromCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer' );
        $certificado = SimpleCFDI::getCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer', false );

        $sello = SimpleCFDI::signData(SimpleCFDI::getPrivateKey(APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.key', $contribuyente_clave_privada), $this->cadenaOriginal);

        $this->xml->sellar($this->sello, $this->noCertificado, $this->certificado);

        $this->xml->saveFile($this->tmp_file);
    }

    public function sellar(){
        $cuenta = $this->cfdi->cuenta();

        $contribuyente = $this->cfdi->emisor();
        $contribuyente_rfc = $contribuyente->rfc;

        $certificado = Certificado::buscar("cuenta_id = $cuenta->id AND activo='SI'","fecha_emision DESC");
        $contribuyente_no_certificado = $certificado->numero_serie;
        $contribuyente_clave_privada = $certificado->clave_privada;

        $noCertificado = SimpleCFDI::getSerialFromCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer' );

        if(!$noCertificado){
            throw new CfdiException("No se encontro el número del certificado.");
        }

        $certificado = CfdiBase::getCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer', false );

        if(!$certificado){
            throw new CfdiException("No se encontro el el certificado.");
        }

        $sello = CfdiBase::signData(CfdiBase::getPrivateKey(APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.key', $contribuyente_clave_privada), $this->cadenaOriginal);

        if(!$sello){
            throw new CFDIException("No se pudo sellar la cadena original, no se encontro el certificado (.key) o la clave privada no es valida.");
        }

        $this->xml->sellar($sello, $noCertificado, $certificado);

        $this->sello = $sello;
        $this->noCertificado = $noCertificado;
        $this->certificado = $certificado;

        $this->xml->saveFile($this->tmp_file);
    }

    public function timbrar($url = false){
        if(!$url){
            $response = WsFacturadorElectronico::timbrado($this->tmp_file);
        }
        else{
            $response = WsFacturadorElectronico::timbrado($url);
        }

        if($response["obtenerTimbradoResult"]["timbre"]["!esValido"] == true){
            $timbre = $response["obtenerTimbradoResult"]["timbre"]["TimbreFiscalDigital"];

            $this->xml->timbrar($timbre);
        }

        return $response;
    }

    public function addendar(){
        $this->xml->addendar();
    }

    public function guardar($url = false){
        if(!$url){
            $this->xml->saveFile($this->tmp_file);
        }
        else{
            $this->xml->saveFile($url);
        }
    }

    public function cadenaOriginal(){
        $cadena = $this->cadenaOriginal;

        $cadena = "|".substr($cadena,3);
        $cadena = substr($cadena,0,strlen($cadena)-4)."||";

        return $cadena;
    }
}