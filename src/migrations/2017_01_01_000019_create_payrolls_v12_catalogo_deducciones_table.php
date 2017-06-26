<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaDeduccion;

class CreatePayrollsV12CatalogoDeduccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_deducciones', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->timestamps();
        });

        NominaDeduccion::create(array('code' => '001', 'name' => "SEGURIDAD SOCIAL"));
        NominaDeduccion::create(array('code' => '002', 'name' => "ISR"));
        NominaDeduccion::create(array('code' => '003', 'name' => "APORTACIONES A RETIRO, CESANTÍA EN EDAD AVANZADA Y VEJEZ."));
        NominaDeduccion::create(array('code' => '004', 'name' => "OTROS"));
        NominaDeduccion::create(array('code' => '005', 'name' => "APORTACIONES A FONDO DE VIVIENDA"));
        NominaDeduccion::create(array('code' => '006', 'name' => "DESCUENTO POR INCAPACIDAD"));
        NominaDeduccion::create(array('code' => '007', 'name' => "PENSIÓN ALIMENTICIA"));
        NominaDeduccion::create(array('code' => '008', 'name' => "RENTA"));
        NominaDeduccion::create(array('code' => '009', 'name' => "PRÉSTAMOS PROVENIENTES DEL FONDO NACIONAL DE LA VIVIENDA PARA LOS TRABAJADORES"));
        NominaDeduccion::create(array('code' => '010', 'name' => "PAGO POR CRÉDITO DE VIVIENDA"));
        NominaDeduccion::create(array('code' => '011', 'name' => "PAGO DE ABONOS INFONACOT"));
        NominaDeduccion::create(array('code' => '012', 'name' => "ANTICIPO DE SALARIOS"));
        NominaDeduccion::create(array('code' => '013', 'name' => "PAGOS HECHOS CON EXCESO AL TRABAJADOR"));
        NominaDeduccion::create(array('code' => '014', 'name' => "ERRORES"));
        NominaDeduccion::create(array('code' => '015', 'name' => "PÉRDIDAS"));
        NominaDeduccion::create(array('code' => '016', 'name' => "AVERÍAS"));
        NominaDeduccion::create(array('code' => '017', 'name' => "ADQUISICIÓN DE ARTÍCULOS PRODUCIDOS POR LA EMPRESA O ESTABLECIMIENTO"));
        NominaDeduccion::create(array('code' => '018', 'name' => "CUOTAS PARA LA CONSTITUCIÓN Y FOMENTO DE SOCIEDADES COOPERATIVAS Y DE CAJAS DE AHORRO"));
        NominaDeduccion::create(array('code' => '019', 'name' => "CUOTAS SINDICALES"));
        NominaDeduccion::create(array('code' => '020', 'name' => "AUSENCIA (AUSENTISMO)"));
        NominaDeduccion::create(array('code' => '021', 'name' => "CUOTAS OBRERO PATRONALES"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfdi_v12_nomina_cat_deducciones');
    }
}
