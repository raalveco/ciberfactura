<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaIncapacidad extends Model{
    protected $table = "cfdi_v12_nomina_cat_incapacidades";

    protected $fillable = ['code', 'name'];
}