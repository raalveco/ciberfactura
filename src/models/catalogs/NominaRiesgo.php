<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaRiesgo extends Model{
    protected $table = "cfdi_v12_nomina_cat_riesgos";

    protected $fillable = ['code', 'name'];
}