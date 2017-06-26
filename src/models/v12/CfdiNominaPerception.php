<?php
namespace Raalveco\Ciberfactura\Models\V12;

use \Illuminate\Database\Eloquent\Model;

class CfdiNominaPerception extends Model{
    protected $table = "cfdi_v12_nomina_percepciones";

    protected $fillable = [
        "id",
        "account_id",
        "cfdi_id",
        "nomina_id",
        "tipo",
        "clave",
        "concepto",
        "importe_gravado",
        "importe_exento"
    ];
}