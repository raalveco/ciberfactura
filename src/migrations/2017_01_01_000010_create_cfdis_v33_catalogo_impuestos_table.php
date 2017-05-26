<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiImpuesto;

class CreateCfdisV33CatalogoImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_impuestos', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->boolean('traslado')->default(true);
            $table->boolean('retencion')->default(true);

            $table->timestamps();
        });

        CfdiImpuesto::create(["code" => "ISR", "name" => "ISR", "traslado" => false, "retecion" => true]);
        CfdiImpuesto::create(["code" => "IVA", "name" => "IVA", "traslado" => true, "retecion" => true]);
        CfdiImpuesto::create(["code" => "IEPS", "name" => "IEPS", "traslado" => true, "retecion" => true]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_impuestos');
    }
}
