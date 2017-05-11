<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiTipoRelacion;

class CreateCfdisV33CatalogoTiposRelacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_tipos_relacion', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiTipoRelacion::create(["code" => "01", "name" => "Nota de crédito de los documentos relacionados"]);
        CfdiTipoRelacion::create(["code" => "02", "name" => "Nota de débito de los documentos relacionados"]);
        CfdiTipoRelacion::create(["code" => "03", "name" => "Devolución de mercancía sobre facturas o traslados previos"]);
        CfdiTipoRelacion::create(["code" => "04", "name" => "Sustitución de los CFDI previos"]);
        CfdiTipoRelacion::create(["code" => "05", "name" => "Traslados de mercancias facturados previamente"]);
        CfdiTipoRelacion::create(["code" => "06", "name" => "Factura generada por los traslados previos"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_tipos_relacion');
    }
}
