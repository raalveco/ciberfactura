<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptsTable extends Migration {

    public function up()
    {
        Schema::create('cfdi_conceptos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->decimal('cantidad',10,2);
            $table->string('unidad');
            $table->string('noIdentificacion')->nulleable();
            $table->text('descripcion');
            $table->decimal('valorUnitario',10,2);
            $table->decimal('importe',10,2);

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_conceptos');
    }

}
