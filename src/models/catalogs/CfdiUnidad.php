<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiUnidad extends Model{
    protected $table = "cfdi_v33_cat_unidades";

    protected $fillable = ['code', 'name'];
}