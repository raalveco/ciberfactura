<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;

class CfdiMetodoPago extends Model{
    protected $table = "cfdi_v33_metodos_pago";

    protected $fillable = ['code', 'name'];
}