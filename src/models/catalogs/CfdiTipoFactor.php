<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiTipoFactor extends Model{
    protected $table = "cfdi_v33_cat_tipos_factor";

    protected $fillable = ['code', 'name'];
}