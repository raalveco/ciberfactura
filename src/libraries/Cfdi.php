<?php
namespace Raalveco\Ciberfactura\Libraries;

use Illuminate\Support\Str;

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
        try {
            $timbre = $this->timbrador->timbrar($this->xml->getXML());

            if(!$timbre || !is_object($timbre) || get_class($timbre) != 'Raalveco\\Ciberfactura\\Libraries\\CfdiStamp'){
                throw new CfdiException("El timbrador tiene que ser un objeto de la clase Raalveco\\Ciberfactura\\Libraries\\CfdiStamp.");
            }

            $this->cfdi->addTimbre([
                'version' => $timbre->version,
                'uuid' => $timbre->uuid,
                'fecha_timbrado' => str_replace("T"," ", $timbre->fecha_timbrado),
                'rfc_prov_certif' => $timbre->rfc,
                'sello_cfd' => $timbre->sello_cfd,
                'no_certificado_sat' => $timbre->no_certificado_sat,
                'sello_sat' => $timbre->sello_sat
            ]);

            $this->xml->timbrar($timbre);

            $this->cfdi->uuid = $timbre->uuid;
            $this->cfdi->save();

            $this->guardar();

            return $timbre->uuid;
        }
        catch(\Exception $e){
            throw $e;

            return;
        }
    }

    public function cancelar(){
        try{
            return $this->timbrador->cancelar($this->cfdi->uuid);
        }
        catch(CfdiException $e){
            throw $e;
        }
    }

    public function guardar($path = false){
        if(!$path){
            $this->xml->saveFile(public_path()."/cfdis/".strtoupper($this->cfdi->uuid).".xml");
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