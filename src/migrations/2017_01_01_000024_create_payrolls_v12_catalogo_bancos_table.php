<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaBanco;

class CreatePayrollsV12CatalogoBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_bancos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('fiscal_name');
            $table->timestamps();
        });

        NominaBanco::create(array('code' => '002', 'name' => "BANAMEX",));
        NominaBanco::create(array('code' => '006', 'name' => "BANCOMEXT",));
        NominaBanco::create(array('code' => '009', 'name' => "BANOBRAS",));
        NominaBanco::create(array('code' => '012', 'name' => "BBVA BANCOMER"));
        NominaBanco::create(array('code' => '014', 'name' => "SANTANDER",));
        NominaBanco::create(array('code' => '019', 'name' => "BANJERCITO",));
        NominaBanco::create(array('code' => '021', 'name' => "HSBC",));
        NominaBanco::create(array('code' => '030', 'name' => "BAJIO",));
        NominaBanco::create(array('code' => '032', 'name' => "IXE"));
        NominaBanco::create(array('code' => '036', 'name' => "INBURSA"));
        NominaBanco::create(array('code' => '037', 'name' => "INTERACCIONES"));
        NominaBanco::create(array('code' => '042', 'name' => "MIFEL"));
        NominaBanco::create(array('code' => '044', 'name' => "SCOTIABANK"));
        NominaBanco::create(array('code' => '058', 'name' => "BANREGIO"));
        NominaBanco::create(array('code' => '059', 'name' => "INVEX"));
        NominaBanco::create(array('code' => '060', 'name' => "BANSI"));
        NominaBanco::create(array('code' => '062', 'name' => "AFIRME"));
        NominaBanco::create(array('code' => '072', 'name' => "BANORTE"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v12_nomina_cat_bancos');
    }
}
