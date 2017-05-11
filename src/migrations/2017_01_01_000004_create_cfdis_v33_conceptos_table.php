<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV33ConceptosTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v33_conceptos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->string('clave_prod_serv');
            $table->string('no_identificacion')->nullable();
            $table->decimal('cantidad',14,6);
            $table->string('clave_unidad');
            $table->string('unidad')->nullable();
            $table->string('descripcion');
            $table->decimal('valor_unitario',10,2);
            $table->decimal('importe',10,2);
            $table->decimal('descuento',10,2);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v33_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cfdi_v33_conceptos');
    }
}
