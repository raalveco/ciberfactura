<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\CfdiMetodoPago;

class CreateCfdisV33MetodosPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_metodos_pago', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiMetodoPago::create(["code" => "PUE", "name" => "Pago en una sola exhibición"]);
        CfdiMetodoPago::create(["code" => "PIP", "name" => "Pago Inicial y Parcialidades"]);
        CfdiMetodoPago::create(["code" => "PPD", "name" => "Pago en Parcialidades o Diferido"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfdi_v33_metodos_pago');
    }
}
