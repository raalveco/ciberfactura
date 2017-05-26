<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV32FacturasTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v32_facturas', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('version')->default("3.3");
            $table->string('serie',25)->default("");
            $table->string('folio',20)->default("");
            $table->dateTime('fecha');
            $table->text('sello')->nullable()->default("");
            $table->string('forma_pago')->default("Pago en una sola exhibición");
            $table->string('no_certificado',20)->nullable()->default("");
            $table->text('certificado')->nullable()->default("");
            $table->string('condiciones_de_pago')->nullable()->default("");
            $table->decimal('sub_total', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->text('motivo_descuento')->nullable()->default("");
            $table->string('moneda')->nullable()->default("");
            $table->string('tipo_cambio')->nullable()->default("");
            $table->decimal('total', 10, 2);
            $table->string('tipo_de_comprobante')->default("ingreso");
            $table->string('metodo_pago')->default("efectivo");
            $table->string('num_cta_pago')->nulleable();
            $table->string('uuid')->nullable()->default("");
            $table->text('cadena_original');

            $table->string('folio_fiscal_orig')->nullable();
            $table->string('serie_folio_fiscal_orig')->nullable();
            $table->dateTime('fecha_folio_fiscal_orig')->nullable();
            $table->decimal('monto_folio_fiscal_orig', 12, 4)->nullable();

            $table->string('estado')->default("EMITIDA");

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cfdi_v32_facturas');
    }
}
