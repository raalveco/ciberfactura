<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiFormaPago;

class CreateCfdisV33FormasPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_formas_pago', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiFormaPago::create(["code" => "01", "name" => "Efectivo"]);
        CfdiFormaPago::create(["code" => "02", "name" => "Cheque"]);
        CfdiFormaPago::create(["code" => "03", "name" => "Transferencia"]);
        CfdiFormaPago::create(["code" => "04", "name" => "Tarjeta de Crédito"]);
        CfdiFormaPago::create(["code" => "05", "name" => "Monedero Electrónico"]);
        CfdiFormaPago::create(["code" => "06", "name" => "Dinero Electrónico"]);
        CfdiFormaPago::create(["code" => "08", "name" => "Vales de Despensa"]);
        CfdiFormaPago::create(["code" => "12", "name" => "Dación de Pago"]);
        CfdiFormaPago::create(["code" => "13", "name" => "Pago por Subrogación"]);
        CfdiFormaPago::create(["code" => "14", "name" => "Pago por Consignación"]);
        CfdiFormaPago::create(["code" => "15", "name" => "Condonación"]);
        CfdiFormaPago::create(["code" => "17", "name" => "Compensación"]);
        CfdiFormaPago::create(["code" => "23", "name" => "Novación"]);
        CfdiFormaPago::create(["code" => "24", "name" => "Confusión"]);
        CfdiFormaPago::create(["code" => "25", "name" => "Remisión de Deuda"]);
        CfdiFormaPago::create(["code" => "26", "name" => "Prescripción o Caducidad"]);
        CfdiFormaPago::create(["code" => "27", "name" => "A satisfacción del acreedor"]);
        CfdiFormaPago::create(["code" => "28", "name" => "Tarjeta de Débito"]);
        CfdiFormaPago::create(["code" => "29", "name" => "Tarjeta de Servicios"]);
        CfdiFormaPago::create(["code" => "99", "name" => "Por Definir"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_formas_pago');
    }
}
