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

            $table->string('calle')->nulleable();
            $table->string('no_exterior', 50)->nulleable();
            $table->string('no_interior', 50)->nulleable();
            $table->string('colonia')->nulleable();
            $table->string('localidad')->nulleable();
            $table->string('referencia')->nulleable();
            $table->string('municipio')->nulleable();
            $table->string('estado', 50)->nulleable();
            $table->string('pais')->default("MEXICO")->nulleable();
            $table->string('codigo_postal',5)->nulleable();

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_sucursales');
    }
}
