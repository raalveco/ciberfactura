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

        return $this->sello;
    }

    public function timbrar(){
        $timbrador = new CfdiTimbrador();

        print_r($timbrador); echo "<br><br>";

        $response = $timbrador->timbrar($this->xml->getXML());

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