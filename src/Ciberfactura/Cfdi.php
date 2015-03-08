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

        $timbre = simplexml_load_string($response->TimbrarXMLResult);

        print_r($timbre);

        $this->cfdi->addComplemento($timbre->version, $timbre->UUID, $timbre->FechaTimbrado, $timbre->selloCFD, $timbre->noCertificadoSAT, $timbre->selloSAT);
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
            $this->xml->saveFile($this->tmp_file);
        }
        else{
            $this->xml->saveFile($path);
        }
    }

    public function addendar(){
        $this->xml->addendar();
    }

}