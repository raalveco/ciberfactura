<?php
use \Illuminate\Database\Eloquent\Model;

class CfdiFactura extends Model{
    protected $table = "cfdi_facturas";

    public function addEmisor($rfc, $nombre="", $calle="", $exterior="", $interior="", $colonia="", $localidad="", $municipio="", $estado="", $pais="", $cp=""){
        $this->save();

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

    public function addReceptor($rfc, $nombre="", $calle="", $exterior="", $interior="", $colonia="", $localidad="", $municipio="", $estado="", $pais="", $cp=""){
        $this->save();

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

    public function addConcepto($cantidad, $unidad, $concepto, $precio, $importe){
        $concepto = new CfdiConcepto();

        $concepto->cfdi_id = $this->id;
        $concepto->cantidad = $cantidad;
        $concepto->unidad = $unidad;
        $concepto->descripcion = $concepto;
        $concepto->valorUnitario = $precio;
        $concepto->importe = $importe;

        $concepto->save();
    }

    public function addImpuesto($tipo, $impuesto, $tasa, $importe){
        $impuesto = new CfdiImpuesto();

        $impuesto->cfdi_id = $this->id;
        $impuesto->tipo = $tipo;
        $impuesto->impuesto = $impuesto;
        $impuesto->tasa = $tasa;
        $impuesto->importe = $importe;

        $impuesto->save();
    }

    public function addRegimen($regimen){
        $regimen = new CfdiRegimen();

        $regimen->cfdi_id = $this->id;
        $regimen->regimen = $regimen;

        $regimen->save();
    }

    public function emisor(){
        return CfdiEmisor::whereRaw("cfdi_id = $this->id")->first();
    }

    public function receptor(){
        return CfdiReceptor::whereRaw("cfdi_id = $this->id")->first();
    }

    public function conceptos(){
        return CfdiConcepto::whereRaw("cfdi_id = $this->id")->get();
    }

    public function impuestos(){
        return CfdiImpuesto::whereRaw("cfdi_id = $this->id")->get();
    }

    public function regimenes(){
        return CfdiRegimen::whereRaw("cfdi_id = $this->id")->get();
    }

    public function sucursal(){
        return CfdiSucursal::whereRaw("cfdi_id = $this->id")->first();
    }

    public function complemento(){
        return CfdiComplemento::whereRaw("cfdi_id = $this->id")->first();
    }
}