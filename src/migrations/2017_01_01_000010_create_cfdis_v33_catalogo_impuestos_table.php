<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiImpuesto;

class CreateCfdisV33CatalogoImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_impuestos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiImpuesto::create(["code" => "ISR", "name" => "Pago en una sola exhibición"]);
        CfdiImpuesto::create(["code" => "IVA", "name" => "Pago Inicial y Parcialidades"]);
        CfdiImpuesto::create(["code" => "IEPS", "name" => "Pago en Parcialidades o Diferido"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_impuestos');
    }
}
