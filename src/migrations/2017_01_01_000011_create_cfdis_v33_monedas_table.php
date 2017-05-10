<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiMoneda;

class CreateCfdisV33MonedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_monedas', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiMoneda::create(["code" => "AED", "name" => "Dirham de EAU"]);
        CfdiMoneda::create(["code" => "AFN", "name" => "Afghani"]);
        CfdiMoneda::create(["code" => "ALL", "name" => "Lek"]);
        CfdiMoneda::create(["code" => "AMD", "name" => "Dram armenio"]);
        CfdiMoneda::create(["code" => "ANG", "name" => "Florín antillano neerlandés"]);
        CfdiMoneda::create(["code" => "AOA", "name" => "Kwanza"]);
        CfdiMoneda::create(["code" => "ARS", "name" => "Peso Argentino"]);
        CfdiMoneda::create(["code" => "AUD", "name" => "Dólar Australiano"]);
        CfdiMoneda::create(["code" => "AWG", "name" => "Aruba Florin"]);
        CfdiMoneda::create(["code" => "AZN", "name" => "Azerbaijanian Manat"]);
        CfdiMoneda::create(["code" => "BAM", "name" => "Convertibles marca"]);
        CfdiMoneda::create(["code" => "BBD", "name" => "Dólar de Barbados"]);
        CfdiMoneda::create(["code" => "BDT", "name" => "Taka"]);
        CfdiMoneda::create(["code" => "BGN", "name" => "Lev búlgaro"]);
        CfdiMoneda::create(["code" => "BHD", "name" => "Dinar de Bahrein"]);
        CfdiMoneda::create(["code" => "BIF", "name" => "Burundi Franc"]);
        CfdiMoneda::create(["code" => "BMD", "name" => "Dólar de Bermudas"]);
        CfdiMoneda::create(["code" => "BND", "name" => "Dólar de Brunei"]);
        CfdiMoneda::create(["code" => "BOB", "name" => "Boliviano"]);
        CfdiMoneda::create(["code" => "BOV", "name" => "Mvdol"]);
        CfdiMoneda::create(["code" => "BRL", "name" => "Real brasileño"]);
        CfdiMoneda::create(["code" => "BSD", "name" => "Dólar de las Bahamas"]);
        CfdiMoneda::create(["code" => "BTN", "name" => "Ngultrum"]);
        CfdiMoneda::create(["code" => "BWP", "name" => "Pula"]);
        CfdiMoneda::create(["code" => "BYR", "name" => "Rublo bielorruso"]);
        CfdiMoneda::create(["code" => "BZD", "name" => "Dólar de Belice"]);
        CfdiMoneda::create(["code" => "CAD", "name" => "Dolar Canadiense"]);
        CfdiMoneda::create(["code" => "CDF", "name" => "Franco congoleño"]);
        CfdiMoneda::create(["code" => "CHE", "name" => "WIR Euro"]);
        CfdiMoneda::create(["code" => "CHF", "name" => "Franco Suizo"]);
        CfdiMoneda::create(["code" => "CHW", "name" => "Franc WIR"]);
        CfdiMoneda::create(["code" => "CLF", "name" => "Unidad de Fomento"]);
        CfdiMoneda::create(["code" => "CLP", "name" => "Peso chileno"]);
        CfdiMoneda::create(["code" => "CNY", "name" => "Yuan Renminbi"]);
        CfdiMoneda::create(["code" => "COP", "name" => "Peso Colombiano"]);
        CfdiMoneda::create(["code" => "COU", "name" => "Unidad de Valor real"]);
        CfdiMoneda::create(["code" => "CRC", "name" => "Colón costarricense"]);
        CfdiMoneda::create(["code" => "CUC", "name" => "Peso Convertible"]);
        CfdiMoneda::create(["code" => "CUP", "name" => "Peso Cubano"]);
        CfdiMoneda::create(["code" => "CVE", "name" => "Cabo Verde Escudo"]);
        CfdiMoneda::create(["code" => "CZK", "name" => "Corona checa"]);
        CfdiMoneda::create(["code" => "DJF", "name" => "Franco de Djibouti"]);
        CfdiMoneda::create(["code" => "DKK", "name" => "Corona danesa"]);
        CfdiMoneda::create(["code" => "DOP", "name" => "Peso Dominicano"]);
        CfdiMoneda::create(["code" => "DZD", "name" => "Dinar argelino"]);
        CfdiMoneda::create(["code" => "EGP", "name" => "Libra egipcia"]);
        CfdiMoneda::create(["code" => "ERN", "name" => "Nakfa"]);
        CfdiMoneda::create(["code" => "ETB", "name" => "Birr etíope"]);
        CfdiMoneda::create(["code" => "EUR", "name" => "Euro"]);
        CfdiMoneda::create(["code" => "FJD", "name" => "Dólar de Fiji"]);
        CfdiMoneda::create(["code" => "FKP", "name" => "Libra malvinense"]);
        CfdiMoneda::create(["code" => "GBP", "name" => "Libra Esterlina"]);
        CfdiMoneda::create(["code" => "GEL", "name" => "Lari"]);
        CfdiMoneda::create(["code" => "GHS", "name" => "Cedi de Ghana"]);
        CfdiMoneda::create(["code" => "GIP", "name" => "Libra de Gibraltar"]);
        CfdiMoneda::create(["code" => "GMD", "name" => "Dalasi"]);
        CfdiMoneda::create(["code" => "GNF", "name" => "Franco guineano"]);
        CfdiMoneda::create(["code" => "GTQ", "name" => "Quetzal"]);
        CfdiMoneda::create(["code" => "GYD", "name" => "Dólar guyanés"]);
        CfdiMoneda::create(["code" => "HKD", "name" => "Dolar De Hong Kong"]);
        CfdiMoneda::create(["code" => "HNL", "name" => "Lempira"]);
        CfdiMoneda::create(["code" => "HRK", "name" => "Kuna"]);
        CfdiMoneda::create(["code" => "HTG", "name" => "Gourde"]);
        CfdiMoneda::create(["code" => "HUF", "name" => "Florín"]);
        CfdiMoneda::create(["code" => "IDR", "name" => "Rupia"]);
        CfdiMoneda::create(["code" => "ILS", "name" => "Nuevo Shekel Israelí"]);
        CfdiMoneda::create(["code" => "INR", "name" => "Rupia india"]);
        CfdiMoneda::create(["code" => "IQD", "name" => "Dinar iraquí"]);
        CfdiMoneda::create(["code" => "IRR", "name" => "Rial iraní"]);
        CfdiMoneda::create(["code" => "ISK", "name" => "Corona islandesa"]);
        CfdiMoneda::create(["code" => "JMD", "name" => "Dólar Jamaiquino"]);
        CfdiMoneda::create(["code" => "JOD", "name" => "Dinar jordano"]);
        CfdiMoneda::create(["code" => "JPY", "name" => "Yen"]);
        CfdiMoneda::create(["code" => "KES", "name" => "Chelín keniano"]);
        CfdiMoneda::create(["code" => "KGS", "name" => "Som"]);
        CfdiMoneda::create(["code" => "KHR", "name" => "Riel"]);
        CfdiMoneda::create(["code" => "KMF", "name" => "Franco Comoro"]);
        CfdiMoneda::create(["code" => "KPW", "name" => "Corea del Norte ganó"]);
        CfdiMoneda::create(["code" => "KRW", "name" => "Won"]);
        CfdiMoneda::create(["code" => "KWD", "name" => "Dinar kuwaití"]);
        CfdiMoneda::create(["code" => "KYD", "name" => "Dólar de las Islas Caimán"]);
        CfdiMoneda::create(["code" => "KZT", "name" => "Tenge"]);
        CfdiMoneda::create(["code" => "LAK", "name" => "Kip"]);
        CfdiMoneda::create(["code" => "LBP", "name" => "Libra libanesa"]);
        CfdiMoneda::create(["code" => "LKR", "name" => "Rupia de Sri Lanka"]);
        CfdiMoneda::create(["code" => "LRD", "name" => "Dólar liberiano"]);
        CfdiMoneda::create(["code" => "LSL", "name" => "Loti"]);
        CfdiMoneda::create(["code" => "LYD", "name" => "Dinar libio"]);
        CfdiMoneda::create(["code" => "MAD", "name" => "Dirham marroquí"]);
        CfdiMoneda::create(["code" => "MDL", "name" => "Leu moldavo"]);
        CfdiMoneda::create(["code" => "MGA", "name" => "Ariary malgache"]);
        CfdiMoneda::create(["code" => "MKD", "name" => "Denar"]);
        CfdiMoneda::create(["code" => "MMK", "name" => "Kyat"]);
        CfdiMoneda::create(["code" => "MNT", "name" => "Tugrik"]);
        CfdiMoneda::create(["code" => "MOP", "name" => "Pataca"]);
        CfdiMoneda::create(["code" => "MRO", "name" => "Ouguiya"]);
        CfdiMoneda::create(["code" => "MUR", "name" => "Rupia de Mauricio"]);
        CfdiMoneda::create(["code" => "MVR", "name" => "Rupia"]);
        CfdiMoneda::create(["code" => "MWK", "name" => "Kwacha"]);
        CfdiMoneda::create(["code" => "MXN", "name" => "Peso Mexicano"]);
        CfdiMoneda::create(["code" => "MXV", "name" => "México Unidad de Inversión (UDI)"]);
        CfdiMoneda::create(["code" => "MYR", "name" => "Ringgit malayo"]);
        CfdiMoneda::create(["code" => "MZN", "name" => "Mozambique Metical"]);
        CfdiMoneda::create(["code" => "NAD", "name" => "Dólar de Namibia"]);
        CfdiMoneda::create(["code" => "NGN", "name" => "Naira"]);
        CfdiMoneda::create(["code" => "NIO", "name" => "Córdoba Oro"]);
        CfdiMoneda::create(["code" => "NOK", "name" => "Corona noruega"]);
        CfdiMoneda::create(["code" => "NPR", "name" => "Rupia nepalí"]);
        CfdiMoneda::create(["code" => "NZD", "name" => "Dólar de Nueva Zelanda"]);
        CfdiMoneda::create(["code" => "OMR", "name" => "Rial omaní"]);
        CfdiMoneda::create(["code" => "PAB", "name" => "Balboa"]);
        CfdiMoneda::create(["code" => "PEN", "name" => "Nuevo Sol"]);
        CfdiMoneda::create(["code" => "PGK", "name" => "Kina"]);
        CfdiMoneda::create(["code" => "PHP", "name" => "Peso filipino"]);
        CfdiMoneda::create(["code" => "PKR", "name" => "Rupia de Pakistán"]);
        CfdiMoneda::create(["code" => "PLN", "name" => "Zloty"]);
        CfdiMoneda::create(["code" => "PYG", "name" => "Guaraní"]);
        CfdiMoneda::create(["code" => "QAR", "name" => "Qatar Rial"]);
        CfdiMoneda::create(["code" => "RON", "name" => "Leu rumano"]);
        CfdiMoneda::create(["code" => "RSD", "name" => "Dinar serbio"]);
        CfdiMoneda::create(["code" => "RUB", "name" => "Rublo ruso"]);
        CfdiMoneda::create(["code" => "RWF", "name" => "Franco ruandés"]);
        CfdiMoneda::create(["code" => "SAR", "name" => "Riyal saudí"]);
        CfdiMoneda::create(["code" => "SBD", "name" => "Dólar de las Islas Salomón"]);
        CfdiMoneda::create(["code" => "SCR", "name" => "Rupia de Seychelles"]);
        CfdiMoneda::create(["code" => "SDG", "name" => "Libra sudanesa"]);
        CfdiMoneda::create(["code" => "SEK", "name" => "Corona sueca"]);
        CfdiMoneda::create(["code" => "SGD", "name" => "Dolar De Singapur"]);
        CfdiMoneda::create(["code" => "SHP", "name" => "Libra de Santa Helena"]);
        CfdiMoneda::create(["code" => "SLL", "name" => "Leona"]);
        CfdiMoneda::create(["code" => "SOS", "name" => "Chelín somalí"]);
        CfdiMoneda::create(["code" => "SRD", "name" => "Dólar de Suriname"]);
        CfdiMoneda::create(["code" => "SSP", "name" => "Libra sudanesa Sur"]);
        CfdiMoneda::create(["code" => "STD", "name" => "Dobra"]);
        CfdiMoneda::create(["code" => "SVC", "name" => "Colon El Salvador"]);
        CfdiMoneda::create(["code" => "SYP", "name" => "Libra Siria"]);
        CfdiMoneda::create(["code" => "SZL", "name" => "Lilangeni"]);
        CfdiMoneda::create(["code" => "THB", "name" => "Baht"]);
        CfdiMoneda::create(["code" => "TJS", "name" => "Somoni"]);
        CfdiMoneda::create(["code" => "TMT", "name" => "Turkmenistán nuevo manat"]);
        CfdiMoneda::create(["code" => "TND", "name" => "Dinar tunecino"]);
        CfdiMoneda::create(["code" => "TOP", "name" => "Pa'anga"]);
        CfdiMoneda::create(["code" => "TRY", "name" => "Lira turca"]);
        CfdiMoneda::create(["code" => "TTD", "name" => "Dólar de Trinidad y Tobago"]);
        CfdiMoneda::create(["code" => "TWD", "name" => "Nuevo dólar de Taiwán"]);
        CfdiMoneda::create(["code" => "TZS", "name" => "Shilling tanzano"]);
        CfdiMoneda::create(["code" => "UAH", "name" => "Hryvnia"]);
        CfdiMoneda::create(["code" => "UGX", "name" => "Shilling de Uganda"]);
        CfdiMoneda::create(["code" => "USD", "name" => "Dolar americano"]);
        CfdiMoneda::create(["code" => "USN", "name" => "Dólar estadounidense (día siguiente)"]);
        CfdiMoneda::create(["code" => "UYI", "name" => "Peso Uruguay en Unidades Indexadas (URUIURUI)"]);
        CfdiMoneda::create(["code" => "UYU", "name" => "Peso Uruguayo"]);
        CfdiMoneda::create(["code" => "UZS", "name" => "Uzbekistán Sum"]);
        CfdiMoneda::create(["code" => "VEF", "name" => "Bolívar"]);
        CfdiMoneda::create(["code" => "VND", "name" => "Dong"]);
        CfdiMoneda::create(["code" => "VUV", "name" => "Vatu"]);
        CfdiMoneda::create(["code" => "WST", "name" => "Tala"]);
        CfdiMoneda::create(["code" => "XAF", "name" => "Franco CFA BEAC"]);
        CfdiMoneda::create(["code" => "XAG", "name" => "Plata"]);
        CfdiMoneda::create(["code" => "XAU", "name" => "Oro"]);
        CfdiMoneda::create(["code" => "XBA", "name" => "Unidad de Mercados de Bonos Unidad Europea Composite (EURCO)"]);
        CfdiMoneda::create(["code" => "XBB", "name" => "Unidad Monetaria de Bonos de Mercados Unidad Europea (UEM-6)"]);
        CfdiMoneda::create(["code" => "XBC", "name" => "Mercados de Bonos Unidad Europea unidad de cuenta a 9 (UCE-9)"]);
        CfdiMoneda::create(["code" => "XBD", "name" => "Mercados de Bonos Unidad Europea unidad de cuenta a 17 (UCE-17)"]);
        CfdiMoneda::create(["code" => "XCD", "name" => "Dólar del Caribe Oriental"]);
        CfdiMoneda::create(["code" => "XDR", "name" => "DEG (Derechos Especiales de Giro)"]);
        CfdiMoneda::create(["code" => "XOF", "name" => "Franco CFA BCEAO"]);
        CfdiMoneda::create(["code" => "XPD", "name" => "Paladio"]);
        CfdiMoneda::create(["code" => "XPF", "name" => "Franco CFP"]);
        CfdiMoneda::create(["code" => "XPT", "name" => "Platino"]);
        CfdiMoneda::create(["code" => "XSU", "name" => "Sucre"]);
        CfdiMoneda::create(["code" => "XTS", "name" => "Códigos reservados específicamente para propósitos de prueba"]);
        CfdiMoneda::create(["code" => "XUA", "name" => "Unidad ADB de Cuenta"]);
        CfdiMoneda::create(["code" => "XXX", "name" => "Los códigos asignados para las transacciones en que intervenga ninguna moneda"]);
        CfdiMoneda::create(["code" => "YER", "name" => "Rial yemení"]);
        CfdiMoneda::create(["code" => "ZAR", "name" => "Rand"]);
        CfdiMoneda::create(["code" => "ZMW", "name" => "Kwacha zambiano"]);
        CfdiMoneda::create(["code" => "ZWL", "name" => "Zimbabwe Dólar"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_monedas');
    }
}
