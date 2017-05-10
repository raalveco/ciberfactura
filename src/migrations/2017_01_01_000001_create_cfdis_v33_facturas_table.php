<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisV33FacturasTable extends Migration
{
    public function up()
    {
        Schema::create('cfdi_v33_facturas', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('version')->default("3.3");
            $table->string('serie',25)->default("");
            $table->string('folio',20)->default("");
            $table->dateTime('fecha');
            $table->text('sello');
            $table->string('forma_pago');
            $table->string('no_certificado',20)->nullable()->default("");
            $table->text('certificado');
            $table->string('condiciones_de_pago')->nullable()->default("");
            $table->decimal('sub_total', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->string('moneda')->nullable();
            $table->string('tipo_cambio')->nullable()->default("");
            $table->decimal('total', 10, 2);
            $table->string('tipo_de_comprobante')->default("I");
            $table->string('metodo_pago')->default("PUE");
            $table->string('lugar_expedicion')->nullable()->default("");

            $table->string('uuid')->nullable()->default("");
            $table->text('cadena_original');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cfdi_v33_facturas');
    }
}
