<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV33ImpuestosTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v33_impuestos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();
            $table->integer('cfdi_concepto_id')->unsigned();

            $table->string('type')->default("traslado");

            $table->decimal('base',10,2);
            $table->string('impuesto');
            $table->string('tipo_factor');
            $table->decimal('tasa_o_cuota',7,6);
            $table->decimal('importe',10,2);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v33_facturas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cfdi_concepto_id')->references('id')->on('cfdi_v33_conceptos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v33_impuestos');
    }
}
