<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiRegimen;

class CreateCfdisV33CatalogoRegimenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_regimenes', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->boolean('physical');
            $table->boolean('moral');

            $table->timestamps();
        });

        CfdiRegimen::create(["code" => "601", 'physical' => 0, 'moral' => 1, "name" => "General de Ley Personas Morales"]);
        CfdiRegimen::create(["code" => "603", 'physical' => 0, 'moral' => 1, "name" => "Personas Morales con Fines no Lucrativos"]);
        CfdiRegimen::create(["code" => "605", 'physical' => 1, 'moral' => 0, "name" => "Sueldos y Salarios e Ingresos Asimilados a Salarios"]);
        CfdiRegimen::create(["code" => "606", 'physical' => 1, 'moral' => 0, "name" => "Arrendamiento"]);
        CfdiRegimen::create(["code" => "608", 'physical' => 1, 'moral' => 0, "name" => "Demás ingresos"]);
        CfdiRegimen::create(["code" => "609", 'physical' => 0, 'moral' => 1, "name" => "Consolidación"]);
        CfdiRegimen::create(["code" => "610", 'physical' => 1, 'moral' => 1, "name" => "Residentes en el Extranjero sin Establecimiento Permanente en México"]);
        CfdiRegimen::create(["code" => "611", 'physical' => 1, 'moral' => 0, "name" => "Ingresos por Dividendos (socios y accionistas)"]);
        CfdiRegimen::create(["code" => "612", 'physical' => 1, 'moral' => 0, "name" => "Personas Físicas con Actividades Empresariales y Profesionales"]);
        CfdiRegimen::create(["code" => "614", 'physical' => 1, 'moral' => 0, "name" => "Ingresos por intereses"]);
        CfdiRegimen::create(["code" => "616", 'physical' => 1, 'moral' => 0, "name" => "Sin obligaciones fiscales"]);
        CfdiRegimen::create(["code" => "620", 'physical' => 0, 'moral' => 1, "name" => "Sociedades Cooperativas de Producción que optan por diferir sus ingresos"]);
        CfdiRegimen::create(["code" => "621", 'physical' => 1, 'moral' => 0, "name" => "Incorporación Fiscal"]);
        CfdiRegimen::create(["code" => "622", 'physical' => 1, 'moral' => 1, "name" => "Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras"]);
        CfdiRegimen::create(["code" => "623", 'physical' => 0, 'moral' => 1, "name" => "Opcional para Grupos de Sociedades"]);
        CfdiRegimen::create(["code" => "624", 'physical' => 0, 'moral' => 1, "name" => "Coordinados"]);
        CfdiRegimen::create(["code" => "628", 'physical' => 0, 'moral' => 1, "name" => "Hidrocarburos"]);
        CfdiRegimen::create(["code" => "607", 'physical' => 0, 'moral' => 1, "name" => "Régimen de Enajenación o Adquisición de Bienes"]);
        CfdiRegimen::create(["code" => "629", 'physical' => 1, 'moral' => 0, "name" => "De los Regímenes Fiscales Preferentes y de las Empresas Multinacionales"]);
        CfdiRegimen::create(["code" => "630", 'physical' => 1, 'moral' => 0, "name" => "Enajenación de acciones en bolsa de valores"]);
        CfdiRegimen::create(["code" => "615", 'physical' => 1, 'moral' => 0, "name" => "Régimen de los ingresos por obtención de premios"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_regimenes');
    }
}
