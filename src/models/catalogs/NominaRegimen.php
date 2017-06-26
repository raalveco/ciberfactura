<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaRegimen extends Model{
    protected $table = "cfdi_v12_nomina_cat_regimenes";

    protected $fillable = ['code', 'name'];
}