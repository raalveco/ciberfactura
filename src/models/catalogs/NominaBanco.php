<?php
namespace Raalveco\Ciberfactura\Models\Catalogs;

use \Illuminate\Database\Eloquent\Model;

class NominaBanco extends Model{
    protected $table = "cfdi_v12_nomina_cat_bancos";

    protected $fillable = ['code', 'name'];
}