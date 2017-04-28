<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\CfdiFormaPago;

class CreateCfdisV33FormasPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_formas_pago', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiFormaPago::create(["code" => "01", "descripcion" => "Efectivo"]);
        CfdiFormaPago::create(["code" => "02", "descripcion" => "Cheque"]);
        CfdiFormaPago::create(["code" => "03", "descripcion" => "Transferencia"]);
        CfdiFormaPago::create(["code" => "04", "descripcion" => "Tarjeta de Crédito"]);
        CfdiFormaPago::create(["code" => "05", "descripcion" => "Monedero Electrónico"]);
        CfdiFormaPago::create(["code" => "06", "descripcion" => "Dinero Electrónico"]);
        CfdiFormaPago::create(["code" => "08", "descripcion" => "Vales de Despensa"]);
        CfdiFormaPago::create(["code" => "12", "descripcion" => "Dación de Pago"]);
        CfdiFormaPago::create(["code" => "13", "descripcion" => "Pago por Subrogación"]);
        CfdiFormaPago::create(["code" => "14", "descripcion" => "Pago por Consignación"]);
        CfdiFormaPago::create(["code" => "15", "descripcion" => "Condonación"]);
        CfdiFormaPago::create(["code" => "17", "descripcion" => "Compensación"]);
        CfdiFormaPago::create(["code" => "23", "descripcion" => "Novación"]);
        CfdiFormaPago::create(["code" => "24", "descripcion" => "Confusión"]);
        CfdiFormaPago::create(["code" => "25", "descripcion" => "Remisión de Deuda"]);
        CfdiFormaPago::create(["code" => "26", "descripcion" => "Prescripción o Caducidad"]);
        CfdiFormaPago::create(["code" => "27", "descripcion" => "A satisfacción del acreedor"]);
        CfdiFormaPago::create(["code" => "28", "descripcion" => "Tarjeta de Débito"]);
        CfdiFormaPago::create(["code" => "29", "descripcion" => "Tarjeta de Servicios"]);
        CfdiFormaPago::create(["code" => "99", "descripcion" => "Por Definir"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfdi_v33_formas_pago');
    }
}
