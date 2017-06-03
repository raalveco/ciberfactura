<?php
namespace Raalveco\Ciberfactura\Models\V32;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Raalveco\Ciberfactura\Libraries\CfdiException;

class CfdiFactura extends Model{
    protected $table = "cfdi_v32_facturas";

    protected $fillable = ['id', 'version','serie','folio','fecha','forma_pago','condiciones_de_pago','sub_total','descuento', 'motivo_descuento','moneda','tipo_cambio','total','tipo_de_comprobante','metodo_pago', 'lugar_expedicion'];

    public function emisor(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\V32\CfdiEmisor', 'cfdi_id');
    }

    public function receptor(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\V32\CfdiReceptor', 'cfdi_id');
    }

    public function conceptos(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\V32\CfdiConcepto', 'cfdi_id');
    }

    public function impuestos(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\V32\CfdiImpuesto', 'cfdi_id');
    }

    public function sucursal(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\V32\CfdiSucursal', 'cfdi_id');
    }

    public function complemento(){
        return $this->hasOne('Raalveco\Ciberfactura\Models\V32\CfdiComplemento', 'cfdi_id');
    }

    public function regimenes(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\V32\CfdiRegimen', 'cfdi_id');
    }
}