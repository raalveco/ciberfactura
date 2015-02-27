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

use Illuminate\Config;

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
        $url = app_path()."/".Config::get('raalveco/ciberfactura::config.cer');

        echo $url;

        //$this->noCertificado = CfdiBase::getSerialFromCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer' );
        //$this->certificado = CfdiBase::getCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer', false );
    }

    public function constructor($cfdi){

        $this->cfdi = CfdiFactura::consultar($cfdi);

        $this->xml = new XmlGenerator($this->cfdi);

        $this->tmp_file = APP_PATH."public/temp/".sha1(date("Y-m-d H:i:s".rand(0,100000))).".xml";

        $this->xml->saveFile($this->tmp_file);

        $this->cadenaOriginal = SimpleCFDI::getCadenaOriginal($this->tmp_file, APP_PATH.'cadenaoriginal_3_2.xslt');
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
            throw new CFDIException("No se encontro el número del certificado.");
        }

        $certificado = SimpleCFDI::getCertificate( APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.cer', false );

        if(!$certificado){
            throw new CFDIException("No se encontro el el certificado.");
        }

        $sello = SimpleCFDI::signData(SimpleCFDI::getPrivateKey(APP_PATH.'public/cfdi/'.$contribuyente_rfc.'/certificado/'.$contribuyente_no_certificado.'.key', $contribuyente_clave_privada), $this->cadenaOriginal);

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

    public static function test()
    {
        $factura = new CfdiFactura();

        $factura->serie = "AX";
        $factura->folio = 3894;

        $factura->total = 116.00;

        $factura->save();
    }
}