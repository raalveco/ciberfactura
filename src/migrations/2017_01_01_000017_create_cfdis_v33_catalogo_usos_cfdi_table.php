<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiUso;

class CreateCfdisV33CatalogoUsosCfdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_usos_cfdi', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiUso::create(["code" => "G01", "name" => "Adquisición de mercancias"]);
        CfdiUso::create(["code" => "G02", "name" => "Devoluciones, descuentos o bonificaciones"]);
        CfdiUso::create(["code" => "G03", "name" => "Gastos en general"]);
        CfdiUso::create(["code" => "I01", "name" => "Construcciones"]);
        CfdiUso::create(["code" => "I02", "name" => "Mobilario y equipo de oficina por inversiones"]);
        CfdiUso::create(["code" => "I03", "name" => "Equipo de transporte"]);
        CfdiUso::create(["code" => "I04", "name" => "Equipo de computo y accesorios"]);
        CfdiUso::create(["code" => "I05", "name" => "Dados, troqueles, moldes, matrices y herramental"]);
        CfdiUso::create(["code" => "I06", "name" => "Comunicaciones telefónicas"]);
        CfdiUso::create(["code" => "I07", "name" => "Comunicaciones satelitales"]);
        CfdiUso::create(["code" => "I08", "name" => "Otra maquinaria y equipo"]);
        CfdiUso::create(["code" => "D01", "name" => "Honorarios médicos, dentales y gastos hospitalarios."]);
        CfdiUso::create(["code" => "D02", "name" => "Gastos médicos por incapacidad o discapacidad"]);
        CfdiUso::create(["code" => "D03", "name" => "Gastos funerales"]);
        CfdiUso::create(["code" => "D04", "name" => "Donativos"]);
        CfdiUso::create(["code" => "D05", "name" => "Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)"]);
        CfdiUso::create(["code" => "D06", "name" => "Aportaciones voluntarias al SAR"]);
        CfdiUso::create(["code" => "D07", "name" => "Primas por seguros de gastos médicos"]);
        CfdiUso::create(["code" => "D08", "name" => "Gastos de transportación escolar obligatoria"]);
        CfdiUso::create(["code" => "D09", "name" => "Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones"]);
        CfdiUso::create(["code" => "D10", "name" => "Pagos por servicios educativos (colegiaturas)"]);
        CfdiUso::create(["code" => "P01", "name" => "Por definir"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_usos_cfdi');
    }
}
