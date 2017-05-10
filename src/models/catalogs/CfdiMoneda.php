<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiMoneda extends Model{
    protected $table = "cfdi_v33_cat_monedas";

    protected $fillable = ['code', 'name'];
}