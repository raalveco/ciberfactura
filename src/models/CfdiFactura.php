<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;

class CfdiFactura extends Model{
    protected $table = "cfdi_facturas";

    protected $guarded = array();

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

    public function addConcepto($cantidad, $unidad, $descripcion, $precio, $importe){
        $concepto = new CfdiConcepto();

        $concepto->cfdi_id = $this->id;
        $concepto->cantidad = $cantidad;
        $concepto->unidad = $unidad;
        $concepto->descripcion = $descripcion;
        $concepto->valorUnitario = $precio;
        $concepto->importe = $importe;

        $concepto->save();

        return $concepto;
    }

    public function addImpuesto($tipo, $impuesto_name, $tasa, $importe){
        $impuesto = new CfdiImpuesto();

        $impuesto->cfdi_id = $this->id;
        $impuesto->tipo = $tipo;
        $impuesto->impuesto = $impuesto_name;
        $impuesto->tasa = $tasa;
        $impuesto->importe = $importe;

        $impuesto->save();

        return $impuesto;
    }

    public function addRegimen($regimen_name){
        $regimen = new CfdiRegimen();

        $regimen->cfdi_id = $this->id;
        $regimen->regimen = $regimen_name   ;

        $regimen->save();

        return $regimen;
    }

    public function addSucursal($calle="", $exterior="", $interior="", $colonia="", $localidad="", $municipio="", $estado="", $pais="", $cp=""){
        $this->save();

        if(CfdiSucursal::whereRaw("cfdi_id = $this->id")->count() > 0){
            $sucursal = CfdiSucursal::whereRaw("cfdi_id = $this->id")->first();
        }
        else{
            $sucursal = new CfdiSucursal();
        }

        $sucursal->cfdi_id = $this->id;
        $sucursal->calle = $calle;
        $sucursal->noExterior = $exterior;
        $sucursal->noInterior = $interior;
        $sucursal->colonia = $colonia;
        $sucursal->localidad = $localidad;
        $sucursal->municipio = $municipio;
        $sucursal->estado = $estado;
        $sucursal->pais = $pais;
        $sucursal->codigoPostal = $cp;

        $sucursal->save();

        return $sucursal;
    }

    public function addComplemento($version, $uuid, $fecha, $selloCFD, $certificadoSAT, $selloSAT){
        $this->uuid = $uuid;
        $this->save();

        if(CfdiComplemento::whereRaw("cfdi_id = $this->id")->count() > 0){
            $complemento = CfdiComplemento::whereRaw("cfdi_id = $this->id")->first();
        }
        else{
            $complemento = new CfdiComplemento();
        }

        $complemento->cfdi_id = $this->id;
        $complemento->version = $version;
        $complemento->UUID = $uuid;
        $complemento->fechaTimbrado = $fecha;
        $complemento->selloCFD = $selloCFD;
        $complemento->noCertificadoSAT = $certificadoSAT;
        $complemento->selloSAT = $selloSAT;

        $complemento->save();

        return $complemento;
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

    public function concepts(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\CfdiConcepto', 'cfdi_id');
    }

    public function impuestos(){
        return CfdiImpuesto::whereRaw("cfdi_id = $this->id")->get();
    }

    public function taxes(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\CfdiImpuesto', 'cfdi_id');
    }

    public function regimen(){
        return CfdiRegimen::whereRaw("cfdi_id = $this->id")->first();
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

    public function uuid(){
        if($this->complemento()){
            return $this->complemento()->UUID;
        }

        return false;
    }
}