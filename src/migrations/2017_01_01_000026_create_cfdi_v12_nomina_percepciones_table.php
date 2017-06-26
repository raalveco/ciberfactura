<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdiV12NominaPercepcionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cfdi_v12_nomina_percepciones', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('account_id')->unsigned();
			$table->integer('cfdi_id')->unsigned();
			$table->integer('nomina_id')->unsigned();

			$table->string('tipo')->default("")->nulleable();
			$table->string('clave')->default("")->nulleable();
			$table->text('concepto')->default("")->nulleable();
			$table->decimal('importe_gravado',10,4)->nulleable();
			$table->decimal('importe_exento',10,4)->nulleable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cfdi_v12_nomina_percepciones');
	}

}
