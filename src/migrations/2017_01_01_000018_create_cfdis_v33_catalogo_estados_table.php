<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiEstado;

class CreateCfdisV33CatalogoEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_estados', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiEstado::create(["code" => "AGU", "name" => "Aguascalientes"]);
        CfdiEstado::create(["code" => "BCN", "name" => "Baja California Norte"]);
        CfdiEstado::create(["code" => "BCS", "name" => "Baja California Sur"]);
        CfdiEstado::create(["code" => "CAM", "name" => "Campeche"]);
        CfdiEstado::create(["code" => "CHH", "name" => "Chihuahua"]);
        CfdiEstado::create(["code" => "CHP", "name" => "Chiapas"]);
        CfdiEstado::create(["code" => "COA", "name" => "Coahuila"]);
        CfdiEstado::create(["code" => "COL", "name" => "Colima"]);
        CfdiEstado::create(["code" => "DIF", "name" => "Distrito Federal"]);
        CfdiEstado::create(["code" => "DUR", "name" => "Durango"]);
        CfdiEstado::create(["code" => "GRO", "name" => "Guerrero"]);
        CfdiEstado::create(["code" => "GUA", "name" => "Guanajuato"]);
        CfdiEstado::create(["code" => "HID", "name" => "Hidalgo"]);
        CfdiEstado::create(["code" => "JAL", "name" => "Jalisco"]);
        CfdiEstado::create(["code" => "MEX", "name" => "Estado de México"]);
        CfdiEstado::create(["code" => "MIC", "name" => "Michoacán"]);
        CfdiEstado::create(["code" => "MOR", "name" => "Morelos"]);
        CfdiEstado::create(["code" => "NAY", "name" => "Nayarit"]);
        CfdiEstado::create(["code" => "NLE", "name" => "Nuevo León"]);
        CfdiEstado::create(["code" => "OAX", "name" => "Oaxaca"]);
        CfdiEstado::create(["code" => "PUE", "name" => "Puebla"]);
        CfdiEstado::create(["code" => "QUE", "name" => "Queretaro"]);
        CfdiEstado::create(["code" => "ROO", "name" => "Quintana Roo"]);
        CfdiEstado::create(["code" => "SIN", "name" => "Sinaloa"]);
        CfdiEstado::create(["code" => "SLP", "name" => "San Luis Potosí"]);
        CfdiEstado::create(["code" => "SON", "name" => "Sonora"]);
        CfdiEstado::create(["code" => "TAB", "name" => "Tabasco"]);
        CfdiEstado::create(["code" => "TAM", "name" => "Tamaulipas"]);
        CfdiEstado::create(["code" => "TLA", "name" => "Tlaxcala"]);
        CfdiEstado::create(["code" => "VER", "name" => "Veracruz"]);
        CfdiEstado::create(["code" => "YUC", "name" => "Yucatán"]);
        CfdiEstado::create(["code" => "ZAC", "name" => "Zacatecas"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_estados');
    }
}
