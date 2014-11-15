<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplementsTable extends Migration {

    public function up()
    {
        Schema::create('cfdi_complementos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('version', 10);
            $table->string('UUID', 36);
            $table->dateTime('fechaTimbrado');
            $table->text('selloCFD');
            $table->string('noCertificadoSAT', 20);
            $table->text('selloSAT');

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_complementos');
    }

}
