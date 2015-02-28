<?php
use \Illuminate\Database\Eloquent\Model;

class CfdiFactura extends Model{
    protected $table = "cfdi_facturas";

    public function emisor($rfc = false, $nombre="", $calle="", $exterior="", $interior="", $colonia="", $localidad="", $municipio="", $estado="", $pais="", $cp=""){
        $this->save();

        if($rfc === false){
            return CfdiEmisor::whereRaw("cfdi_id = $this->id")->first();
        }

        if(CfdiEmisor::whereRaw("cfdi_id = $this->id")->count() > 0){
            $emisor = CfdiEmisor::whereRaw("cfdi_id = $this->id")->first();
        }
        else{
            $emisor = new CfdiEmisor();
        }

        $emisor->cfdi_id = $this->id;
        $emisor->rfc = $rfc;
        $emisor->nombre = $nombre;
        $emisor->calle = $calle;
        $emisor->noExterior = $exterior;
        $emisor->noInterior = $interior;
        $emisor->colonia = $colonia;
        $emisor->localidad = $localidad;
        $emisor->municipio = $municipio;
        $emisor->estado = $estado;
        $emisor->pais = $pais;
        $emisor->codigoPostal = $cp;

        $emisor->save();

        return $emisor;
    }

    public function receptor($rfc = false, $nombre="", $calle="", $exterior="", $interior="", $colonia="", $localidad="", $municipio="", $estado="", $pais="", $cp=""){
        $this->save();

        if($rfc === false){
            return CfdiReceptor::whereRaw("cfdi_id = $this->id")->first();
        }

        if(CfdiReceptor::whereRaw("cfdi_id = $this->id")->count() > 0){
            $receptor = CfdiReceptor::whereRaw("cfdi_id = $this->id")->first();
        }
        else{
            $receptor = new CfdiReceptor();
        }

        $receptor->cfdi_id = $this->id;
        $receptor->rfc = $rfc;
        $receptor->nombre = $nombre;
        $receptor->calle = $calle;
        $receptor->noExterior = $exterior;
        $receptor->noInterior = $interior;
        $receptor->colonia = $colonia;
        $receptor->localidad = $localidad;
        $receptor->municipio = $municipio;
        $receptor->estado = $estado;
        $receptor->pais = $pais;
        $receptor->codigoPostal = $cp;

        $receptor->save();

        return $receptor;
    }
}