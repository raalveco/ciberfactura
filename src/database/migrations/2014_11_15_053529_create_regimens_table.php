<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimensTable extends Migration {

    public function up()
    {
        Schema::create('cfdi_regimenes', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('cfdi_id')->unsigned();

            $table->string('regimen');

            $table->timestamps();

            $table->foreign('cfdi_id')->references('id')->on('cfdi_facturas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('cfdi_regimenes');
    }

}
