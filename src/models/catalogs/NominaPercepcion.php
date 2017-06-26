<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaPercepcion extends Model{
    protected $table = "cfdi_v12_nomina_cat_percepciones";

    protected $fillable = ['code', 'name'];
}