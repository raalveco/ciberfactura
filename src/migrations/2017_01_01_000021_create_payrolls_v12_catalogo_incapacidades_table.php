<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaIncapacidad;

class CreatePayrollsV12CatalogoIncapacidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_incapacidades', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->timestamps();
        });

        NominaIncapacidad::create(array('code' => '1', 'name' => "RIESGO DE TRABAJO"));
        NominaIncapacidad::create(array('code' => '2', 'name' => "ENFERMEDAD EN GENERAL"));
        NominaIncapacidad::create(array('code' => '3', 'name' => "MATERNIDAD"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfdi_v12_nomina_cat_incapacidades');
    }
}
