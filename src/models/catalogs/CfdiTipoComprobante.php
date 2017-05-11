<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiTipoComprobante extends Model{
    protected $table = "cfdi_v33_cat_tipos_comprobante";

    protected $fillable = ['code', 'name'];
}