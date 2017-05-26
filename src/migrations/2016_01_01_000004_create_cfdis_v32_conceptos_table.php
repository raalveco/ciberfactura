<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32ConceptosTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_conceptos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->decimal('cantidad',12,4);
            $table->string('unidad');
            $table->string('no_identificacion')->nulleable();
            $table->text('descripcion');
            $table->decimal('valor_unitario',12,4);
            $table->decimal('importe',12,4);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_conceptos');
    }
}
