<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration {

    public function up()
    {
        Schema::create('cfdi_impuestos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('tipo')->default("traslado");
            $table->string('impuesto', 5)->default("IVA");
            $table->decimal('tasa',10,4)->nulleable();
            $table->decimal('importe',10,2);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_impuestos');
    }

}
