<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiMetodoPago extends Model{
    protected $table = "cfdi_v33_cat_metodos_pago";

    protected $fillable = ['code', 'name'];
}