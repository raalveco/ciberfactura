<?php
namespace Raalveco\Ciberfactura\Models\V32;

use \Illuminate\Database\Eloquent\Model;

class CfdiSucursal extends Model{
    protected $table = "cfdi_v32_sucursales";

    protected $fillable = ['id', 'cfdi_id'];
}