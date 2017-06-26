<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaRegimen;

class CreatePayrollsV12CatalogoRegimenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_regimenes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->timestamps();
        });

        NominaRegimen::create(array('code' => '2', 'name' => "SUELDOS Y SALARIOS"));
        NominaRegimen::create(array('code' => '3', 'name' => "JUBILADOS"));
        NominaRegimen::create(array('code' => '4', 'name' => "PENSIONADOS"));
        NominaRegimen::create(array('code' => '5', 'name' => "ASIMILADOS A SALARIOS, MIEMBROS DE LAS SOCIEDADES COOPERATIVAS DE PRODUCCIÓN"));
        NominaRegimen::create(array('code' => '6', 'name' => "ASIMILADOS A SALARIOS, INTEGRANTES DE SOCIEDADES Y ASOCIACIONES CIVILES"));
        NominaRegimen::create(array('code' => '7', 'name' => "ASIMILADOS A SALARIOS, MIEMBROS DE CONSEJOS DIRECTIVOS, DE VIGILANCIA, CONSULTIVOS, HONORARIOS A ADMINISTRADORES, COMISARIOS Y GERENTES GENERALES"));
        NominaRegimen::create(array('code' => '8', 'name' => "ASIMILADOS A SALARIOS, ACTIVIDAD EMPRESARIAL (COMISIONISTAS)"));
        NominaRegimen::create(array('code' => '9', 'name' => "ASIMILADOS A SALARIOS, HONORARIOS ASIMILADOS A SALARIOS"));
        NominaRegimen::create(array('code' => '10', 'name' => "ASIMILADOS A SALARIOS, INGRESOS ACCIONES O TÍTULOS VALOR"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v12_nomina_cat_regimenes');
    }
}
