<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\CfdiUnidad;

class CreateCfdisV33UnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_unidades', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiUnidad::create(["code" => "CMT", "name" => "Centimetro"]);
        CfdiUnidad::create(["code" => "DMT", "name" => "Decimetro"]);
        CfdiUnidad::create(["code" => "MTR", "name" => "Metro"]);
        CfdiUnidad::create(["code" => "A45", "name" => "Decametro"]);
        CfdiUnidad::create(["code" => "KMT", "name" => "Kilometro"]);
        CfdiUnidad::create(["code" => "HMT", "name" => "Hectometro"]);

        CfdiUnidad::create(["code" => "INH", "name" => "Pulgada"]);
        CfdiUnidad::create(["code" => "FOT", "name" => "Pie"]);
        CfdiUnidad::create(["code" => "YRD", "name" => "Yarda"]);
        CfdiUnidad::create(["code" => "SMI", "name" => "Milla"]);
        CfdiUnidad::create(["code" => "NMI", "name" => "Milla Naútica"]);
        CfdiUnidad::create(["code" => "B57", "name" => "Año Luz"]);

        CfdiUnidad::create(["code" => "CMK", "name" => "Centimetro Cuadrado"]);
        CfdiUnidad::create(["code" => "MTK", "name" => "Metro Cuadrado"]);
        CfdiUnidad::create(["code" => "KMK", "name" => "Kilometro Cuadrado"]);
        CfdiUnidad::create(["code" => "H18", "name" => "Hectarea"]);
        CfdiUnidad::create(["code" => "ACR", "name" => "Acre"]);

        CfdiUnidad::create(["code" => "MLT", "name" => "Mililitro"]);
        CfdiUnidad::create(["code" => "LTR", "name" => "Litro"]);
        CfdiUnidad::create(["code" => "MAL", "name" => "Megalitro"]);
        CfdiUnidad::create(["code" => "MTQ", "name" => "Metro Cúbico"]);

        CfdiUnidad::create(["code" => "INQ", "name" => "Pulgada Cúbica"]);
        CfdiUnidad::create(["code" => "FTQ", "name" => "Pie Cúbico"]);
        CfdiUnidad::create(["code" => "YDQ", "name" => "Yarda Cúbica"]);

        CfdiUnidad::create(["code" => "GLL", "name" => "Galón"]);
        CfdiUnidad::create(["code" => "L86", "name" => "Tonelada"]);

        CfdiUnidad::create(["code" => "SEC", "name" => "Segundo"]);
        CfdiUnidad::create(["code" => "MIN", "name" => "Minuto"]);
        CfdiUnidad::create(["code" => "HUR", "name" => "Hora"]);
        CfdiUnidad::create(["code" => "DAY", "name" => "Día"]);
        CfdiUnidad::create(["code" => "WEE", "name" => "Semana"]);
        CfdiUnidad::create(["code" => "MON", "name" => "Mes"]);
        CfdiUnidad::create(["code" => "ANN", "name" => "Año"]);

        CfdiUnidad::create(["code" => "KGM", "name" => "Kilogramo"]);
        CfdiUnidad::create(["code" => "MGM", "name" => "Miligramo"]);
        CfdiUnidad::create(["code" => "LBR", "name" => "Libra"]);
        CfdiUnidad::create(["code" => "ONZ", "name" => "Onza"]);
        CfdiUnidad::create(["code" => "TNE", "name" => "Tonelada"]);

        CfdiUnidad::create(["code" => "WTT", "name" => "Watt"]);
        CfdiUnidad::create(["code" => "KWT", "name" => "Kilowatt"]);
        CfdiUnidad::create(["code" => "MAW", "name" => "Megawatt"]);
        CfdiUnidad::create(["code" => "C31", "name" => "Miliwatt"]);
        CfdiUnidad::create(["code" => "D80", "name" => "Microwatt"]);

        CfdiUnidad::create(["code" => "KWH", "name" => "Kilowatt/Hour"]);
        CfdiUnidad::create(["code" => "WHR", "name" => "Watt/Hour"]);

        CfdiUnidad::create(["code" => "4L", "name" => "Megabyte"]);
        CfdiUnidad::create(["code" => "E34", "name" => "Gigabyte"]);
        CfdiUnidad::create(["code" => "E35", "name" => "Terabyte"]);
        CfdiUnidad::create(["code" => "E36", "name" => "Petabyte"]);
        CfdiUnidad::create(["code" => "E37", "name" => "Pixel"]);
        CfdiUnidad::create(["code" => "E38", "name" => "Megapixel"]);

        CfdiUnidad::create(["code" => "C62", "name" => "Pieza"]);
        CfdiUnidad::create(["code" => "E48", "name" => "Unidad de Servicio"]);
        CfdiUnidad::create(["code" => "E49", "name" => "Día de Trabajo"]);
        CfdiUnidad::create(["code" => "WM", "name" => "Mes de Trabajo"]);
        CfdiUnidad::create(["code" => "E50", "name" => "Unidad Contable"]);
        CfdiUnidad::create(["code" => "E51", "name" => "Trabajo"]);
        CfdiUnidad::create(["code" => "E53", "name" => "Prueba"]);
        CfdiUnidad::create(["code" => "E54", "name" => "Viaje"]);
        CfdiUnidad::create(["code" => "E56", "name" => "Vuelta"]);
        CfdiUnidad::create(["code" => "NMP", "name" => "Paquete"]);
        CfdiUnidad::create(["code" => "NMP", "name" => "Caja"]);
        CfdiUnidad::create(["code" => "NPT", "name" => "Parte"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_unidades');
    }
}
