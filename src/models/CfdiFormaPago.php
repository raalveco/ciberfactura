<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;

class CfdiFormaPago extends Model{
    protected $table = "cfdi_v33_formas_pago";

    protected $fillable = ['code', 'name'];
}