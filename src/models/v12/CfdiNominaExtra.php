<?php
namespace Raalveco\Ciberfactura\Models\V12;

use \Illuminate\Database\Eloquent\Model;

class CfdiNominaExtra extends Model{
    protected $table = "cfdi_v12_nomina_extras";

    protected $fillable = [
        "id",
        "account_id",
        "cfdi_id",
        "nomina_id",
        "dias",
        "horas",
        "tipo",
        "importe"
    ];
}