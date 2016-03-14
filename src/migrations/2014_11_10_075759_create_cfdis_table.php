<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCfdisTable extends Migration {

    public function up()
    {
        Schema::create('cfdi_facturas', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('version')->default("3.2");
            $table->string('serie',25)->nulleable();
            $table->string('folio',20)->nulleable();

            $table->dateTime('fecha');

            $table->string('formaDePago')->default("Pago en una sola exhibición");
            $table->string('noCertificado',20);
            $table->text('certificado');
            $table->string('condicionesDePago')->nulleable();

            $table->decimal('subTotal', 10, 2);

            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->text('motivoDescuento')->nulleable();

            $table->string('tipoCambio')->nulleable();
            $table->string('moneda')->nulleable();

            $table->decimal('total', 10, 2);

            $table->string('tipoDeComprobante')->default("ingreso");
            $table->string('metodoPago')->default("efectivo");
            $table->text('lugarExpedicion')->nulleable();

            $table->string('numCtaPago')->nulleable();
            $table->string('folioFiscalOrig')->nulleable();
            $table->string('serieFolioFiscalOrig')->nulleable();
            $table->dateTime('fechaFolioFiscalOrig')->nulleable();
            $table->decimal('montoFolioFiscalOrig', 10, 2)->nulleable();

            $table->text('cadenaOriginal');
            $table->text('sello');
            $table->string('uuid');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cfdi_facturas');
    }

}
