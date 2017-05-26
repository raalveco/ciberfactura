<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32ComplementosTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_complementos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->string('version', 10);
            $table->string('uuid', 36);
            $table->dateTime('fecha_timbrado');
            $table->text('sello_cfd');
            $table->string('no_certificado_sat', 20);
            $table->text('sello_sat');

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_complementos');
    }
}
