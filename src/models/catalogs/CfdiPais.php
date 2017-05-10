<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiPais extends Model{
    protected $table = "cfdi_v33_cat_paises";

    protected $fillable = ['code', 'name'];
}