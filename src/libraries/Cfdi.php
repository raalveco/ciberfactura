<?php
namespace Raalveco\Ciberfactura\Libraries;

class Cfdi extends CfdiBase{
    public function __construct(){
        parent::__construct();
    }

    public function getInstance($production = false){
        $this->production = $production;
        return $this;
    }

    public function cadenaOriginal(){
        $cadena = $this->cadena_original;

        $cadena = "|".substr($cadena,3);
        $cadena = substr($cadena,0,strlen($cadena)-4)."||";

        return $cadena;
    }

    public function sellar(){
        $this->sello = $this->signData($this->key, $this->cadena_original);

        $this->cfdi->sello = $this->sello;
        $this->cfdi->save();

        $this->xml->sellar($this->sello, $this->no_certificado, $this->certificado);

        return $this->sello;
    }

    public function timbrar(){
        $timbrador = new CfdiTimbrador($this->rfc, $this->certificate, $this->production);

        try {
            $response = $timbrador->timbrar($this->xml->getXML());

            $tmp = substr($response->TimbrarXMLResult, strpos($response->TimbrarXMLResult, 'xsi:schemaLocation="') + 20);
            $tmp = substr($tmp, 0, strpos($tmp, '"'));

            $timbre = simplexml_load_string($response->TimbrarXMLResult);
            $timbre[0]["schemaLocation"] = str_replace('"', '', $tmp);

            $this->cfdi->addComplemento($timbre[0]["version"], strtoupper($timbre[0]["UUID"]), $timbre[0]["FechaTimbrado"], $timbre[0]["selloCFD"], $timbre[0]["noCertificadoSAT"], $timbre[0]["selloSAT"]);
            $this->xml->timbrar($timbre);

            return strtoupper($timbre[0]["UUID"]);
        }
        catch(\Exception $e){
            $this->cfdi->delete();
            throw $e;

            return;
        }
    }

    public function cancelar(){
        try{
            $timbrador = new CfdiTimbrador($this->rfc, $this->certificate, $this->production);

            $response = $timbrador->cancelar($this->uuid());

            file_put_contents(public_path()."/cfdis/".strtoupper($this->cfdi->uuid())."_ACUSE_CANCELACION.xml",$response);

            return $response;
        }
        catch(CfdiException $e){
            throw $e;
        }
    }

    public function guardar($path = false){
        if(!$path){
            $this->xml->saveFile(public_path()."/cfdis/".strtoupper($this->cfdi->uuid()).".xml");
        }
        else{
            $this->xml->saveFile($path);
        }

        return $this->cfdi;
    }

    public function addendar(){
        $this->xml->addendar();
    }

}