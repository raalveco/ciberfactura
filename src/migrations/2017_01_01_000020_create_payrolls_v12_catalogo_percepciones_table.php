<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\NominaPercepcion;

class CreatePayrollsV12CatalogoPercepcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v12_nomina_cat_percepciones', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('code');
            $table->string('name');
            $table->timestamps();
        });

        NominaPercepcion::create(array('code' => '001', 'name' => "SUELDOS, SALARIOS RAYAS Y JORNALES"));
        NominaPercepcion::create(array('code' => '002', 'name' => "GRATIFICACIÓN ANUAL (AGUINALDO)"));
        NominaPercepcion::create(array('code' => '003', 'name' => "PARTICIPACIÓN DE LOS TRABAJADORES EN LAS UTILIDADES PTU"));
        NominaPercepcion::create(array('code' => '004', 'name' => "REEMBOLSO DE GASTOS MÉDICOS DENTALES Y HOSPITALARIOS"));
        NominaPercepcion::create(array('code' => '005', 'name' => "FONDO DE AHORRO"));
        NominaPercepcion::create(array('code' => '006', 'name' => "CAJA DE AHORRO"));
        NominaPercepcion::create(array('code' => '009', 'name' => "CONTRIBUCIONES A CARGO DEL TRABAJADOR PAGADAS POR EL PATRÓN"));
        NominaPercepcion::create(array('code' => '010', 'name' => "PREMIOS POR PUNTUALIDAD"));
        NominaPercepcion::create(array('code' => '011', 'name' => "PRIMA DE SEGURO DE VIDA"));
        NominaPercepcion::create(array('code' => '012', 'name' => "SEGURO DE GASTOS MÉDICOS MAYORES"));
        NominaPercepcion::create(array('code' => '013', 'name' => "CUOTAS SINDICALES PAGADAS POR EL PATRÓN"));
        NominaPercepcion::create(array('code' => '014', 'name' => "SUBSIDIOS POR INCAPACIDAD"));
        NominaPercepcion::create(array('code' => '015', 'name' => "BECAS PARA TRABAJADORES Y/O HIJOS"));
        NominaPercepcion::create(array('code' => '016', 'name' => "OTROS"));
        NominaPercepcion::create(array('code' => '017', 'name' => "SUBSIDIO PARA EL EMPLEO"));
        NominaPercepcion::create(array('code' => '019', 'name' => "HORAS EXTRA"));
        NominaPercepcion::create(array('code' => '020', 'name' => "PRIMA DOMINICAL"));
        NominaPercepcion::create(array('code' => '021', 'name' => "PRIMA VACACIONAL"));
        NominaPercepcion::create(array('code' => '022', 'name' => "PRIMA POR ANTIGÜEDAD"));
        NominaPercepcion::create(array('code' => '023', 'name' => "PAGOS POR SEPARACIÓN"));
        NominaPercepcion::create(array('code' => '024', 'name' => "SEGURO DE RETIRO"));
        NominaPercepcion::create(array('code' => '025', 'name' => "INDEMNIZACIONES"));
        NominaPercepcion::create(array('code' => '026', 'name' => "REEMBOLSO POR FUNERAL"));
        NominaPercepcion::create(array('code' => '027', 'name' => "CUOTAS DE SEGURIDAD SOCIAL PAGADAS POR EL PATRÓN"));
        NominaPercepcion::create(array('code' => '028', 'name' => "COMISIONES"));
        NominaPercepcion::create(array('code' => '029', 'name' => "VALES DE DESPENSA"));
        NominaPercepcion::create(array('code' => '030', 'name' => "VALES DE RESTAURANTE"));
        NominaPercepcion::create(array('code' => '031', 'name' => "VALES DE GASOLINA"));
        NominaPercepcion::create(array('code' => '032', 'name' => "VALES DE ROPA"));
        NominaPercepcion::create(array('code' => '033', 'name' => "AYUDA PARA RENTA"));
        NominaPercepcion::create(array('code' => '034', 'name' => "AYUDA PARA ARTÍCULOS ESCOLARES"));
        NominaPercepcion::create(array('code' => '035', 'name' => "AYUDA PARA ANTEOJOS"));
        NominaPercepcion::create(array('code' => '036', 'name' => "AYUDA PARA TRANSPORTE"));
        NominaPercepcion::create(array('code' => '037', 'name' => "AYUDA PARA GASTOS DE FUNERAL"));
        NominaPercepcion::create(array('code' => '038', 'name' => "OTROS INGRESOS POR SALARIOS"));
        NominaPercepcion::create(array('code' => '039', 'name' => "JUBILACIONES, PENSIONES O HABERES DE RETIRO"));
        NominaPercepcion::create(array('code' => '040', 'name' => "INGRESO PAGADO POR ENTIDADES CON CARGO A SUS PARTICIPACIONES U OTROS INGRESOS LOCALES."));
        NominaPercepcion::create(array('code' => '041', 'name' => "INGRESO PAGADO POR ENTIDADES CON RECURSOS FEDERALES, DISTINTOS A LAS PARTICIPACIONES."));
        NominaPercepcion::create(array('code' => '042', 'name' => "INGRESO PAGADO POR ENTIDADES CON CARGO A SUS PARTICIPACIONES U OTROS INGRESOS LOCALES Y CON RECURSOS FEDERALES DISTINTOS A LAS PARTICIPACIONES."));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cfdi_v12_nomina_cat_percepciones');
    }
}
