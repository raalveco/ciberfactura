<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdiV12NominaIncapacidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cfdi_v12_nomina_incapacidades', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('account_id')->unsigned();
			$table->integer('cfdi_id')->unsigned();
			$table->integer('nomina_id')->unsigned();

			$table->integer('dias')->nulleable();
			$table->string('tipo')->default("")->nulleable();
			$table->decimal('descuento',10,4)->nulleable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cfdi_v12_nomina_incapacidades');
	}

}
