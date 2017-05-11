<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiRegimen extends Model{
    protected $table = "cfdi_v33_cat_regimenes";

    protected $fillable = ['code', 'name'];
}