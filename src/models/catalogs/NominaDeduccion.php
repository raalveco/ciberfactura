<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaDeduccion extends Model{
    protected $table = "cfdi_v12_nomina_cat_deducciones";

    protected $fillable = ['code', 'name'];
}