<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class CfdiTipoRelacion extends Model{
    protected $table = "cfdi_v33_cat_tipos_relacion";

    protected $fillable = ['code', 'name'];
}