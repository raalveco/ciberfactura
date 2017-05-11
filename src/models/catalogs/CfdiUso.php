<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiUso extends Model{
    protected $table = "cfdi_v33_cat_usos_cfdi";

    protected $fillable = ['code', 'name'];
}