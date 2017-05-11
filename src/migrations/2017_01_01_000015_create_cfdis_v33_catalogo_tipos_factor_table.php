<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiTipoFactor;

class CreateCfdisV33CatalogoTiposFactorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_tipos_factor', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiTipoFactor::create(["code" => "Tasa", "name" => "Tasa"]);
        CfdiTipoFactor::create(["code" => "Cuota", "name" => "Cuota"]);
        CfdiTipoFactor::create(["code" => "Exento", "name" => "Exento"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_tipos_factor');
    }
}
