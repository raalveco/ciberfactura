<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV33EmisoresTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v33_emisores', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('rfc',13);
            $table->string('nombre')->nullable();
            $table->string('regimen_fiscal')->nullable();

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_v33_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v33_emisores');
    }
}
