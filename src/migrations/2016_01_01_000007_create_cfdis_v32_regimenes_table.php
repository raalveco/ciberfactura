<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32RegimenesTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_regimenes', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->unsignedInteger('cfdi_id');

            $table->string('regimen');

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v32_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_regimenes');
    }
}
