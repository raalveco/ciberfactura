<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32ImpuestosTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_impuestos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->string('tipo')->default("traslado");
            $table->string('impuesto', 5)->default("IVA");
            $table->decimal('tasa',6,2)->nullable();
            $table->decimal('importe',12,4);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_impuestos');
    }
}
