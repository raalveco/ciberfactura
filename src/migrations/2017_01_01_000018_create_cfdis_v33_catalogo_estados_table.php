<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
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

        CfdiEstado::create(["code" => "AGU", "name" => Str::upper("Aguascalientes")]);
        CfdiEstado::create(["code" => "BCN", "name" => Str::upper("Baja California Norte")]);
        CfdiEstado::create(["code" => "BCS", "name" => Str::upper("Baja California Sur")]);
        CfdiEstado::create(["code" => "CAM", "name" => Str::upper("Campeche")]);
        CfdiEstado::create(["code" => "CHH", "name" => Str::upper("Chihuahua")]);
        CfdiEstado::create(["code" => "CHP", "name" => Str::upper("Chiapas")]);
        CfdiEstado::create(["code" => "COA", "name" => Str::upper("Coahuila")]);
        CfdiEstado::create(["code" => "COL", "name" => Str::upper("Colima")]);
        CfdiEstado::create(["code" => "DIF", "name" => Str::upper("Distrito Federal")]);
        CfdiEstado::create(["code" => "DUR", "name" => Str::upper("Durango")]);
        CfdiEstado::create(["code" => "GRO", "name" => Str::upper("Guerrero")]);
        CfdiEstado::create(["code" => "GUA", "name" => Str::upper("Guanajuato")]);
        CfdiEstado::create(["code" => "HID", "name" => Str::upper("Hidalgo")]);
        CfdiEstado::create(["code" => "JAL", "name" => Str::upper("Jalisco")]);
        CfdiEstado::create(["code" => "MEX", "name" => Str::upper("Estado de México")]);
        CfdiEstado::create(["code" => "MIC", "name" => Str::upper("Michoacán")]);
        CfdiEstado::create(["code" => "MOR", "name" => Str::upper("Morelos")]);
        CfdiEstado::create(["code" => "NAY", "name" => Str::upper("Nayarit")]);
        CfdiEstado::create(["code" => "NLE", "name" => Str::upper("Nuevo León")]);
        CfdiEstado::create(["code" => "OAX", "name" => Str::upper("Oaxaca")]);
        CfdiEstado::create(["code" => "PUE", "name" => Str::upper("Puebla")]);
        CfdiEstado::create(["code" => "QUE", "name" => Str::upper("Queretaro")]);
        CfdiEstado::create(["code" => "ROO", "name" => Str::upper("Quintana Roo")]);
        CfdiEstado::create(["code" => "SIN", "name" => Str::upper("Sinaloa")]);
        CfdiEstado::create(["code" => "SLP", "name" => Str::upper("San Luis Potosí")]);
        CfdiEstado::create(["code" => "SON", "name" => Str::upper("Sonora")]);
        CfdiEstado::create(["code" => "TAB", "name" => Str::upper("Tabasco")]);
        CfdiEstado::create(["code" => "TAM", "name" => Str::upper("Tamaulipas")]);
        CfdiEstado::create(["code" => "TLA", "name" => Str::upper("Tlaxcala")]);
        CfdiEstado::create(["code" => "VER", "name" => Str::upper("Veracruz")]);
        CfdiEstado::create(["code" => "YUC", "name" => Str::upper("Yucatán")]);
        CfdiEstado::create(["code" => "ZAC", "name" => Str::upper("Zacatecas")]);
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
