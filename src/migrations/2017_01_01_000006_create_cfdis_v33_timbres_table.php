<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV33TimbresTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v33_timbres', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('version');
            $table->string('uuid');
            $table->datetime('fecha_timbrado');
            $table->string('rfc_prov_certif');
            $table->text('sello_cfd');
            $table->string('no_certificado_sat');
            $table->text('sello_sat');

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v33_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cfdi_v33_timbres');
    }
}
