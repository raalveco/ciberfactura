<?php
namespace Raalveco\Ciberfactura\Models\V12;

use \Illuminate\Database\Eloquent\Model;

class CfdiNominaIncapacidad extends Model{
    protected $table = "cfdi_v12_nomina_incapacidades";

    protected $fillable = [
        "id",
        "account_id",
        "cfdi_id",
        "nomina_id",
        "dias",
        "tipo",
        "descuento"
    ];
}