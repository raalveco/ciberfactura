<?php
namespace Raalveco\Ciberfactura\Models\V12;

use \Illuminate\Database\Eloquent\Model;

class CfdiNomina extends Model{
    protected $table = "cfdi_v12_nominas";

    protected $fillable = [
        "id",
        "account_id",
        "cfdi_id",
        "employee_id",
        "employer_id",
        "version",
        "registro_patronal",
        "numero_empleado",
        "rfc",
        "curp",
        "tipo_regimen",
        "nss",
        "fecha_pago",
        "fecha_inicial",
        "fecha_final",
        "dias_trabajados",
        "clabe",
        "banco",
        "fecha_contratacion",
        "antiguedad",
        "puesto",
        "tipo_contrato",
        "tipo_jornada",
        "periodicidad",
        "riesgo_puesto",
        "salario_base",
        "salario_integrado",
        "outsourcing",
        "estado",
        "xml",
        "pdf"
    ];

    public function cfdi(){
        return $this->belongsTo('Ciberfactura\CfdiFactura', 'cfdi_id', 'id');
    }

    public function perceptions(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\Catalogs\NominaPercepcion');
    }

    public function deductions(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\Catalogs\NominaDeduccion');
    }

    public function incapacities(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\Catalogs\NominaIncapacidad');
    }

    public function extras(){
        return $this->hasMany('Raalveco\Ciberfactura\Models\Catalogs\NominaExtra');
    }
}