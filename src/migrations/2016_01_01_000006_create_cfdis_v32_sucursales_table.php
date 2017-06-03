<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32SucursalesTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_sucursales', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->string('calle')->nullable()->default("");
            $table->string('no_exterior', 50)->nullable()->default("");
            $table->string('no_interior', 50)->nullable()->default("");
            $table->string('colonia')->nullable()->default("");
            $table->string('localidad')->nullable()->default("");
            $table->string('referencia')->nullable()->default("");
            $table->string('municipio')->nullable()->default("");
            $table->string('estado', 50)->nullable()->default("");
            $table->string('pais')->default("MEXICO")->nullable()->default("");
            $table->string('codigo_postal',5)->nullable()->default("");

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_sucursales');
    }
}
