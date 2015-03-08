<?php
namespace Ciberfactura;

class Cfdi extends CfdiBase{
    public function __construct(CfdiFactura $cfdi){
        parent::__construct($cfdi);
    }

    public function cadenaOriginal(){
        $cadena = $this->cadenaOriginal;

        $cadena = "|".substr($cadena,3);
        $cadena = substr($cadena,0,strlen($cadena)-4)."||";

        return $cadena;
    }

    public function sellar(){
        $this->sello = $this->signData($this->key, $this->cadenaOriginal);

        $this->cfdi->sello = $this->sello;
        $this->cfdi->save();

        $this->xml->sellar($this->sello, $this->noCertificado, $this->certificado);

        return $this->sello;
    }

    public function timbrar(){
        $timbrador = new CfdiTimbrador();

        $response = $timbrador->timbrar($this->xml->getXML());

        $tmp = substr($response->TimbrarXMLResult,strpos($response->TimbrarXMLResult, 'xsi:schemaLocation="') + 20);
        $tmp = substr($tmp,0, strpos($tmp,'"'));

        $timbre = simplexml_load_string($response->TimbrarXMLResult);
        $timbre[0]["schemaLocation"] = str_replace('"','',$tmp);

        $this->cfdi->addComplemento($timbre[0]["version"], $timbre[0]["UUID"], $timbre[0]["FechaTimbrado"], $timbre[0]["selloCFD"], $timbre[0]["noCertificadoSAT"], $timbre[0]["selloSAT"]);
        $this->xml->timbrar($timbre);

        return $response;
    }

    public function cancelar(){
        $timbrador = new CfdiTimbrador();

        $response = $timbrador->cancelar($this->uuid());

        return $response;
    }

    public function guardar($path = false){
        if(!$path){
            $this->xml->saveFile(public_path()."/cfdis/".$this->cfdi->uuid().".xml");
        }
        else{
            $this->xml->saveFile($path);
        }
    }

    public function addendar(){
        $this->xml->addendar();
    }

}