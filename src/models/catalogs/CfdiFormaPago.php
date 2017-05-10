<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiFormaPago extends Model{
    protected $table = "cfdi_v33_cat_formas_pago";

    protected $fillable = ['code', 'name'];
}