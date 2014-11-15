<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmisorsTable extends Migration {

	public function up()
    {
        Schema::create('cfdi_emisores', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('rfc',13);
            $table->string('nombre')->nulleable();

            $table->string('calle')->nulleable();
            $table->string('noExterior', 50)->nulleable();
            $table->string('noInterior', 50)->nulleable();
            $table->string('colonia')->nulleable();
            $table->string('localidad')->nulleable();
            $table->string('referencia')->nulleable();
            $table->string('municipio')->nulleable();
            $table->string('estado', 50)->nulleable();
            $table->string('pais')->default("MEXICO")->nulleable();
            $table->string('codigoPostal',5)->nulleable();

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_emisores');
    }

}
