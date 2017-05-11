<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiEstado extends Model{
    protected $table = "cfdi_v33_cat_estados";

    protected $fillable = ['code', 'name'];
}