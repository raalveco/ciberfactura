<?php
namespace Raalveco\Ciberfactura\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CfdiFormaPago extends Model{
    protected $table = "cfdi_v33_formas_pago";

    protected $fillable = ['code', 'name'];
}