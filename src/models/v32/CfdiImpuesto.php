<?php
namespace Raalveco\Ciberfactura\Models\V32;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CfdiImpuesto extends Model{
    protected $table = "cfdi_v32_impuestos";

    protected $fillable = ['id', 'cfdi_id', 'tipo', 'impuesto', 'tasa', 'importe'];
}