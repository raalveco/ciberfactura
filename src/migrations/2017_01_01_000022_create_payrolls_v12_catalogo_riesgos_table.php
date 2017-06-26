<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaRiesgo;

class CreatePayrollsV12CatalogoRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_riesgos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->timestamps();
        });

        NominaRiesgo::create(array('code' => '1', 'name' => "CLASE I"));
        NominaRiesgo::create(array('code' => '2', 'name' => "CLASE II"));
        NominaRiesgo::create(array('code' => '3', 'name' => "CLASE III"));
        NominaRiesgo::create(array('code' => '4', 'name' => "CLASE IV"));
        NominaRiesgo::create(array('code' => '5', 'name' => "CLASE V"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v12_nomina_cat_riesgos');
    }
}
