<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiTipoComprobante;

class CreateCfdisV33CatalogoTiposComprobanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_tipos_comprobante', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiTipoComprobante::create(["code" => "I", "name" => "Ingreso"]);
        CfdiTipoComprobante::create(["code" => "E", "name" => "Egreso"]);
        CfdiTipoComprobante::create(["code" => "T", "name" => "Traslado"]);
        CfdiTipoComprobante::create(["code" => "N", "name" => "Nómina"]);
        CfdiTipoComprobante::create(["code" => "P", "name" => "Pago"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_tipos_comprobante');
    }
}
