<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdiV12NominasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cfdi_v12_nominas', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('account_id')->unsigned();
			$table->integer('cfdi_id')->unsigned();

			$table->string('version')->default("1.1");
			$table->string('registro_patronal')->nulleable();
			$table->string('numero_empleado')->nulleable();
			$table->string('rfc',13)->nulleable();
			$table->string('curp',50)->nulleable();

			$table->string('tipo_regimen')->nulleable();
			$table->string('nss')->nulleable();
			$table->date('fecha_pago')->nulleable();
			$table->date('fecha_inicial')->nulleable();
			$table->date('fecha_final')->nulleable();
			$table->integer('dias_trabajados')->nulleable();
			$table->string('clabe')->nulleable();
			$table->string('banco')->nulleable();
			$table->date('fecha_contratacion')->nulleable();
			$table->decimal('antiguedad',5,2)->nulleable();
			$table->string('puesto')->nulleable();
			$table->string('tipo_contrato')->nulleable();
			$table->string('tipo_jornada')->nulleable();
			$table->string('periodicidad')->nulleable();
			$table->string('riesgo_puesto')->nulleable();
			$table->decimal('salario_base', 10,4)->nulleable();
			$table->decimal('salario_integrado', 10,4)->nulleable();

			$table->string('estado')->default("EMITIDA");

			$table->string('xml')->nullable();
			$table->string('pdf')->nullable();

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cfdi_v12_nominas');
	}

}
