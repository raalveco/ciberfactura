<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Raalveco\Ciberfactura\Models\Catalogs\CfdiPais;

class CreateCfdisV33CatalogoPaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cfdi_v33_cat_paises', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });

        CfdiPais::create(["code" => "AFG", "name" => "Afganistán"]);
        CfdiPais::create(["code" => "ALA", "name" => "Islas Åland"]);
        CfdiPais::create(["code" => "ALB", "name" => "Albania"]);
        CfdiPais::create(["code" => "DEU", "name" => "Alemania"]);
        CfdiPais::create(["code" => "AND", "name" => "Andorra"]);
        CfdiPais::create(["code" => "AGO", "name" => "Angola"]);
        CfdiPais::create(["code" => "AIA", "name" => "Anguila"]);
        CfdiPais::create(["code" => "ATA", "name" => "Antártida"]);
        CfdiPais::create(["code" => "ATG", "name" => "Antigua y Barbuda"]);
        CfdiPais::create(["code" => "SAU", "name" => "Arabia Saudita"]);
        CfdiPais::create(["code" => "DZA", "name" => "Argelia"]);
        CfdiPais::create(["code" => "ARG", "name" => "Argentina"]);
        CfdiPais::create(["code" => "ARM", "name" => "Armenia"]);
        CfdiPais::create(["code" => "ABW", "name" => "Aruba"]);
        CfdiPais::create(["code" => "AUS", "name" => "Australia"]);
        CfdiPais::create(["code" => "AUT", "name" => "Austria"]);
        CfdiPais::create(["code" => "AZE", "name" => "Azerbaiyán"]);
        CfdiPais::create(["code" => "BHS", "name" => "Bahamas"]);
        CfdiPais::create(["code" => "BGD", "name" => "Bangladés"]);
        CfdiPais::create(["code" => "BRB", "name" => "Barbados"]);
        CfdiPais::create(["code" => "BHR", "name" => "Baréin"]);
        CfdiPais::create(["code" => "BEL", "name" => "Bélgica"]);
        CfdiPais::create(["code" => "BLZ", "name" => "Belice"]);
        CfdiPais::create(["code" => "BEN", "name" => "Benín"]);
        CfdiPais::create(["code" => "BMU", "name" => "Bermudas"]);
        CfdiPais::create(["code" => "BLR", "name" => "Bielorrusia"]);
        CfdiPais::create(["code" => "MMR", "name" => "Myanmar"]);
        CfdiPais::create(["code" => "BOL", "name" => "Bolivia"]);
        CfdiPais::create(["code" => "BIH", "name" => "Bosnia y Herzegovina"]);
        CfdiPais::create(["code" => "BWA", "name" => "Botsuana"]);
        CfdiPais::create(["code" => "BRA", "name" => "Brasil"]);
        CfdiPais::create(["code" => "BRN", "name" => "Brunéi Darussalam"]);
        CfdiPais::create(["code" => "BGR", "name" => "Bulgaria"]);
        CfdiPais::create(["code" => "BFA", "name" => "Burkina Faso"]);
        CfdiPais::create(["code" => "BDI", "name" => "Burundi"]);
        CfdiPais::create(["code" => "BTN", "name" => "Bután"]);
        CfdiPais::create(["code" => "CPV", "name" => "Cabo Verde"]);
        CfdiPais::create(["code" => "KHM", "name" => "Camboya"]);
        CfdiPais::create(["code" => "CMR", "name" => "Camerún"]);
        CfdiPais::create(["code" => "CAN", "name" => "Canadá"]);
        CfdiPais::create(["code" => "QAT", "name" => "Catar"]);
        CfdiPais::create(["code" => "BES", "name" => "Bonaire, San Eustaquio y Saba"]);
        CfdiPais::create(["code" => "TCD", "name" => "Chad"]);
        CfdiPais::create(["code" => "CHL", "name" => "Chile"]);
        CfdiPais::create(["code" => "CHN", "name" => "China"]);
        CfdiPais::create(["code" => "CYP", "name" => "Chipre"]);
        CfdiPais::create(["code" => "COL", "name" => "Colombia"]);
        CfdiPais::create(["code" => "COM", "name" => "Comoras"]);
        CfdiPais::create(["code" => "PRK", "name" => "Corea del Norte"]);
        CfdiPais::create(["code" => "KOR", "name" => "Corea del Sur"]);
        CfdiPais::create(["code" => "CIV", "name" => "Côte d'Ivoire"]);
        CfdiPais::create(["code" => "CRI", "name" => "Costa Rica"]);
        CfdiPais::create(["code" => "HRV", "name" => "Croacia"]);
        CfdiPais::create(["code" => "CUB", "name" => "Cuba"]);
        CfdiPais::create(["code" => "CUW", "name" => "Curaçao"]);
        CfdiPais::create(["code" => "DNK", "name" => "Dinamarca"]);
        CfdiPais::create(["code" => "DMA", "name" => "Dominica"]);
        CfdiPais::create(["code" => "ECU", "name" => "Ecuador"]);
        CfdiPais::create(["code" => "EGY", "name" => "Egipto"]);
        CfdiPais::create(["code" => "SLV", "name" => "El Salvador"]);
        CfdiPais::create(["code" => "ARE", "name" => "Emiratos Árabes Unidos"]);
        CfdiPais::create(["code" => "ERI", "name" => "Eritrea"]);
        CfdiPais::create(["code" => "SVK", "name" => "Eslovaquia"]);
        CfdiPais::create(["code" => "SVN", "name" => "Eslovenia"]);
        CfdiPais::create(["code" => "ESP", "name" => "España"]);
        CfdiPais::create(["code" => "USA", "name" => "Estados Unidos"]);
        CfdiPais::create(["code" => "EST", "name" => "Estonia"]);
        CfdiPais::create(["code" => "ETH", "name" => "Etiopía"]);
        CfdiPais::create(["code" => "PHL", "name" => "Filipinas"]);
        CfdiPais::create(["code" => "FIN", "name" => "Finlandia"]);
        CfdiPais::create(["code" => "FJI", "name" => "Fiyi"]);
        CfdiPais::create(["code" => "FRA", "name" => "Francia"]);
        CfdiPais::create(["code" => "GAB", "name" => "Gabón"]);
        CfdiPais::create(["code" => "GMB", "name" => "Gambia"]);
        CfdiPais::create(["code" => "GEO", "name" => "Georgia"]);
        CfdiPais::create(["code" => "GHA", "name" => "Ghana"]);
        CfdiPais::create(["code" => "GIB", "name" => "Gibraltar"]);
        CfdiPais::create(["code" => "GRD", "name" => "Granada"]);
        CfdiPais::create(["code" => "GRC", "name" => "Grecia"]);
        CfdiPais::create(["code" => "GRL", "name" => "Groenlandia"]);
        CfdiPais::create(["code" => "GLP", "name" => "Guadalupe"]);
        CfdiPais::create(["code" => "GUM", "name" => "Guam"]);
        CfdiPais::create(["code" => "GTM", "name" => "Guatemala"]);
        CfdiPais::create(["code" => "GUF", "name" => "Guayana Francesa"]);
        CfdiPais::create(["code" => "GGY", "name" => "Guernsey"]);
        CfdiPais::create(["code" => "GIN", "name" => "Guinea"]);
        CfdiPais::create(["code" => "GNB", "name" => "Guinea-Bisáu"]);
        CfdiPais::create(["code" => "GNQ", "name" => "Guinea Ecuatorial"]);
        CfdiPais::create(["code" => "GUY", "name" => "Guyana"]);
        CfdiPais::create(["code" => "HTI", "name" => "Haití"]);
        CfdiPais::create(["code" => "HND", "name" => "Honduras"]);
        CfdiPais::create(["code" => "HKG", "name" => "Hong Kong"]);
        CfdiPais::create(["code" => "HUN", "name" => "Hungría"]);
        CfdiPais::create(["code" => "IND", "name" => "India"]);
        CfdiPais::create(["code" => "IDN", "name" => "Indonesia"]);
        CfdiPais::create(["code" => "IRQ", "name" => "Irak"]);
        CfdiPais::create(["code" => "IRN", "name" => "Irán"]);
        CfdiPais::create(["code" => "IRL", "name" => "Irlanda"]);
        CfdiPais::create(["code" => "BVT", "name" => "Isla Bouvet"]);
        CfdiPais::create(["code" => "IMN", "name" => "Isla de Man"]);
        CfdiPais::create(["code" => "CXR", "name" => "Isla de Navidad"]);
        CfdiPais::create(["code" => "NFK", "name" => "Isla Norfolk"]);
        CfdiPais::create(["code" => "ISL", "name" => "Islandia"]);
        CfdiPais::create(["code" => "CYM", "name" => "Islas Caimán"]);
        CfdiPais::create(["code" => "CCK", "name" => "Islas Cocos"]);
        CfdiPais::create(["code" => "COK", "name" => "Islas Cook"]);
        CfdiPais::create(["code" => "FRO", "name" => "Islas Feroe"]);
        CfdiPais::create(["code" => "SGS", "name" => "Georgia del sur y las islas sandwich del sur"]);
        CfdiPais::create(["code" => "HMD", "name" => "Isla Heard e Islas McDonald"]);
        CfdiPais::create(["code" => "FLK", "name" => "Islas Malvinas"]);
        CfdiPais::create(["code" => "MNP", "name" => "Islas Marianas del Norte"]);
        CfdiPais::create(["code" => "MHL", "name" => "Islas Marshall"]);
        CfdiPais::create(["code" => "PCN", "name" => "Pitcairn"]);
        CfdiPais::create(["code" => "SLB", "name" => "Islas Salomón"]);
        CfdiPais::create(["code" => "TCA", "name" => "Islas Turcas y Caicos"]);
        CfdiPais::create(["code" => "UMI", "name" => "Islas de Ultramar Menores de Estados Unidos"]);
        CfdiPais::create(["code" => "VGB", "name" => "Islas Vírgenes (Británicas)"]);
        CfdiPais::create(["code" => "VIR", "name" => "Islas Vírgenes (EE.UU.)"]);
        CfdiPais::create(["code" => "ISR", "name" => "Israel"]);
        CfdiPais::create(["code" => "ITA", "name" => "Italia"]);
        CfdiPais::create(["code" => "JAM", "name" => "Jamaica"]);
        CfdiPais::create(["code" => "JPN", "name" => "Japón"]);
        CfdiPais::create(["code" => "JEY", "name" => "Jersey"]);
        CfdiPais::create(["code" => "JOR", "name" => "Jordania"]);
        CfdiPais::create(["code" => "KAZ", "name" => "Kazajistán"]);
        CfdiPais::create(["code" => "KEN", "name" => "Kenia"]);
        CfdiPais::create(["code" => "KGZ", "name" => "Kirguistán"]);
        CfdiPais::create(["code" => "KIR", "name" => "Kiribati"]);
        CfdiPais::create(["code" => "KWT", "name" => "Kuwait"]);
        CfdiPais::create(["code" => "LAO", "name" => "Lao"]);
        CfdiPais::create(["code" => "LSO", "name" => "Lesoto"]);
        CfdiPais::create(["code" => "LVA", "name" => "Letonia"]);
        CfdiPais::create(["code" => "LBN", "name" => "Líbano"]);
        CfdiPais::create(["code" => "LBR", "name" => "Liberia"]);
        CfdiPais::create(["code" => "LBY", "name" => "Libia"]);
        CfdiPais::create(["code" => "LIE", "name" => "Liechtenstein"]);
        CfdiPais::create(["code" => "LTU", "name" => "Lituania"]);
        CfdiPais::create(["code" => "LUX", "name" => "Luxemburgo"]);
        CfdiPais::create(["code" => "MAC", "name" => "Macao"]);
        CfdiPais::create(["code" => "MDG", "name" => "Madagascar"]);
        CfdiPais::create(["code" => "MYS", "name" => "Malasia"]);
        CfdiPais::create(["code" => "MWI", "name" => "Malaui"]);
        CfdiPais::create(["code" => "MDV", "name" => "Maldivas"]);
        CfdiPais::create(["code" => "MLI", "name" => "Malí"]);
        CfdiPais::create(["code" => "MLT", "name" => "Malta"]);
        CfdiPais::create(["code" => "MAR", "name" => "Marruecos"]);
        CfdiPais::create(["code" => "MTQ", "name" => "Martinica"]);
        CfdiPais::create(["code" => "MUS", "name" => "Mauricio"]);
        CfdiPais::create(["code" => "MRT", "name" => "Mauritania"]);
        CfdiPais::create(["code" => "MYT", "name" => "Mayotte"]);
        CfdiPais::create(["code" => "MEX", "name" => "México"]);
        CfdiPais::create(["code" => "FSM", "name" => "Micronesia"]);
        CfdiPais::create(["code" => "MDA", "name" => "Moldavia"]);
        CfdiPais::create(["code" => "MCO", "name" => "Mónaco"]);
        CfdiPais::create(["code" => "MNG", "name" => "Mongolia"]);
        CfdiPais::create(["code" => "MNE", "name" => "Montenegro"]);
        CfdiPais::create(["code" => "MSR", "name" => "Montserrat"]);
        CfdiPais::create(["code" => "MOZ", "name" => "Mozambique"]);
        CfdiPais::create(["code" => "NAM", "name" => "Namibia"]);
        CfdiPais::create(["code" => "NRU", "name" => "Nauru"]);
        CfdiPais::create(["code" => "NPL", "name" => "Nepal"]);
        CfdiPais::create(["code" => "NIC", "name" => "Nicaragua"]);
        CfdiPais::create(["code" => "NER", "name" => "Níger"]);
        CfdiPais::create(["code" => "NGA", "name" => "Nigeria"]);
        CfdiPais::create(["code" => "NIU", "name" => "Niue"]);
        CfdiPais::create(["code" => "NOR", "name" => "Noruega"]);
        CfdiPais::create(["code" => "NCL", "name" => "Nueva Caledonia"]);
        CfdiPais::create(["code" => "NZL", "name" => "Nueva Zelanda"]);
        CfdiPais::create(["code" => "OMN", "name" => "Omán"]);
        CfdiPais::create(["code" => "NLD", "name" => "Países Bajos"]);
        CfdiPais::create(["code" => "PAK", "name" => "Pakistán"]);
        CfdiPais::create(["code" => "PLW", "name" => "Palaos"]);
        CfdiPais::create(["code" => "PSE", "name" => "Palestina"]);
        CfdiPais::create(["code" => "PAN", "name" => "Panamá"]);
        CfdiPais::create(["code" => "PNG", "name" => "Papúa Nueva Guinea"]);
        CfdiPais::create(["code" => "PRY", "name" => "Paraguay"]);
        CfdiPais::create(["code" => "PER", "name" => "Perú"]);
        CfdiPais::create(["code" => "PYF", "name" => "Polinesia Francesa"]);
        CfdiPais::create(["code" => "POL", "name" => "Polonia"]);
        CfdiPais::create(["code" => "PRT", "name" => "Portugal"]);
        CfdiPais::create(["code" => "PRI", "name" => "Puerto Rico"]);
        CfdiPais::create(["code" => "GBR", "name" => "Reino Unido"]);
        CfdiPais::create(["code" => "CAF", "name" => "República Centroafricana"]);
        CfdiPais::create(["code" => "CZE", "name" => "República Checa"]);
        CfdiPais::create(["code" => "MKD", "name" => "Macedonia"]);
        CfdiPais::create(["code" => "COG", "name" => "Congo"]);
        CfdiPais::create(["code" => "COD", "name" => "Congo"]);
        CfdiPais::create(["code" => "DOM", "name" => "República Dominicana"]);
        CfdiPais::create(["code" => "REU", "name" => "Reunión"]);
        CfdiPais::create(["code" => "RWA", "name" => "Ruanda"]);
        CfdiPais::create(["code" => "ROU", "name" => "Rumania"]);
        CfdiPais::create(["code" => "RUS", "name" => "Rusia, Federación de"]);
        CfdiPais::create(["code" => "ESH", "name" => "Sahara Occidental"]);
        CfdiPais::create(["code" => "WSM", "name" => "Samoa"]);
        CfdiPais::create(["code" => "ASM", "name" => "Samoa Americana"]);
        CfdiPais::create(["code" => "BLM", "name" => "San Bartolomé"]);
        CfdiPais::create(["code" => "KNA", "name" => "San Cristóbal y Nieves"]);
        CfdiPais::create(["code" => "SMR", "name" => "San Marino"]);
        CfdiPais::create(["code" => "MAF", "name" => "San Martín"]);
        CfdiPais::create(["code" => "SPM", "name" => "San Pedro y Miquelón"]);
        CfdiPais::create(["code" => "VCT", "name" => "San Vicente y las Granadinas"]);
        CfdiPais::create(["code" => "SHN", "name" => "Santa Helena, Ascensión y Tristán de Acuña"]);
        CfdiPais::create(["code" => "LCA", "name" => "Santa Lucía"]);
        CfdiPais::create(["code" => "STP", "name" => "Santo Tomé y Príncipe"]);
        CfdiPais::create(["code" => "SEN", "name" => "Senegal"]);
        CfdiPais::create(["code" => "SRB", "name" => "Serbia"]);
        CfdiPais::create(["code" => "SYC", "name" => "Seychelles"]);
        CfdiPais::create(["code" => "SLE", "name" => "Sierra leona"]);
        CfdiPais::create(["code" => "SGP", "name" => "Singapur"]);
        CfdiPais::create(["code" => "SXM", "name" => "Sint Maarten"]);
        CfdiPais::create(["code" => "SYR", "name" => "Siria"]);
        CfdiPais::create(["code" => "SOM", "name" => "Somalia"]);
        CfdiPais::create(["code" => "LKA", "name" => "Sri Lanka"]);
        CfdiPais::create(["code" => "SWZ", "name" => "Suazilandia"]);
        CfdiPais::create(["code" => "ZAF", "name" => "Sudáfrica"]);
        CfdiPais::create(["code" => "SDN", "name" => "Sudán"]);
        CfdiPais::create(["code" => "SSD", "name" => "Sudán del Sur"]);
        CfdiPais::create(["code" => "SWE", "name" => "Suecia"]);
        CfdiPais::create(["code" => "CHE", "name" => "Suiza"]);
        CfdiPais::create(["code" => "SUR", "name" => "Surinam"]);
        CfdiPais::create(["code" => "SJM", "name" => "Svalbard y Jan Mayen"]);
        CfdiPais::create(["code" => "THA", "name" => "Tailandia"]);
        CfdiPais::create(["code" => "TWN", "name" => "Taiwán"]);
        CfdiPais::create(["code" => "TZA", "name" => "Tanzania"]);
        CfdiPais::create(["code" => "TJK", "name" => "Tayikistán"]);
        CfdiPais::create(["code" => "IOT", "name" => "Territorio Británico del Océano Índico"]);
        CfdiPais::create(["code" => "ATF", "name" => "Territorios Australes Franceses"]);
        CfdiPais::create(["code" => "TLS", "name" => "Timor-Leste"]);
        CfdiPais::create(["code" => "TGO", "name" => "Togo"]);
        CfdiPais::create(["code" => "TKL", "name" => "Tokelau"]);
        CfdiPais::create(["code" => "TON", "name" => "Tonga"]);
        CfdiPais::create(["code" => "TTO", "name" => "Trinidad y Tobago"]);
        CfdiPais::create(["code" => "TUN", "name" => "Túnez"]);
        CfdiPais::create(["code" => "TKM", "name" => "Turkmenistán"]);
        CfdiPais::create(["code" => "TUR", "name" => "Turquía"]);
        CfdiPais::create(["code" => "TUV", "name" => "Tuvalu"]);
        CfdiPais::create(["code" => "UKR", "name" => "Ucrania"]);
        CfdiPais::create(["code" => "UGA", "name" => "Uganda"]);
        CfdiPais::create(["code" => "URY", "name" => "Uruguay"]);
        CfdiPais::create(["code" => "UZB", "name" => "Uzbekistán"]);
        CfdiPais::create(["code" => "VUT", "name" => "Vanuatu"]);
        CfdiPais::create(["code" => "VAT", "name" => "Santa Sede"]);
        CfdiPais::create(["code" => "VEN", "name" => "República Bolivariana de Venezuela"]);
        CfdiPais::create(["code" => "VNM", "name" => "Viet Nam"]);
        CfdiPais::create(["code" => "WLF", "name" => "Wallis y Futuna"]);
        CfdiPais::create(["code" => "YEM", "name" => "Yemen"]);
        CfdiPais::create(["code" => "DJI", "name" => "Yibuti"]);
        CfdiPais::create(["code" => "ZMB", "name" => "Zambia"]);
        CfdiPais::create(["code" => "ZWE", "name" => "Zimbabue"]);
        CfdiPais::create(["code" => "ZZZ", "name" => "Países no declarados"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cfdi_v33_cat_paises');
    }
}
