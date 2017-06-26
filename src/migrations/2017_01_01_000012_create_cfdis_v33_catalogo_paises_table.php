<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
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

        CfdiPais::create(["code" => "AFG", "name" => Str::upper("Afganistán")]);
        CfdiPais::create(["code" => "ALA", "name" => Str::upper("Islas Åland")]);
        CfdiPais::create(["code" => "ALB", "name" => Str::upper("Albania")]);
        CfdiPais::create(["code" => "DEU", "name" => Str::upper("Alemania")]);
        CfdiPais::create(["code" => "AND", "name" => Str::upper("Andorra")]);
        CfdiPais::create(["code" => "AGO", "name" => Str::upper("Angola")]);
        CfdiPais::create(["code" => "AIA", "name" => Str::upper("Anguila")]);
        CfdiPais::create(["code" => "ATA", "name" => Str::upper("Antártida")]);
        CfdiPais::create(["code" => "ATG", "name" => Str::upper("Antigua y Barbuda")]);
        CfdiPais::create(["code" => "SAU", "name" => Str::upper("Arabia Saudita")]);
        CfdiPais::create(["code" => "DZA", "name" => Str::upper("Argelia")]);
        CfdiPais::create(["code" => "ARG", "name" => Str::upper("Argentina")]);
        CfdiPais::create(["code" => "ARM", "name" => Str::upper("Armenia")]);
        CfdiPais::create(["code" => "ABW", "name" => Str::upper("Aruba")]);
        CfdiPais::create(["code" => "AUS", "name" => Str::upper("Australia")]);
        CfdiPais::create(["code" => "AUT", "name" => Str::upper("Austria")]);
        CfdiPais::create(["code" => "AZE", "name" => Str::upper("Azerbaiyán")]);
        CfdiPais::create(["code" => "BHS", "name" => Str::upper("Bahamas")]);
        CfdiPais::create(["code" => "BGD", "name" => Str::upper("Bangladés")]);
        CfdiPais::create(["code" => "BRB", "name" => Str::upper("Barbados")]);
        CfdiPais::create(["code" => "BHR", "name" => Str::upper("Baréin")]);
        CfdiPais::create(["code" => "BEL", "name" => Str::upper("Bélgica")]);
        CfdiPais::create(["code" => "BLZ", "name" => Str::upper("Belice")]);
        CfdiPais::create(["code" => "BEN", "name" => Str::upper("Benín")]);
        CfdiPais::create(["code" => "BMU", "name" => Str::upper("Bermudas")]);
        CfdiPais::create(["code" => "BLR", "name" => Str::upper("Bielorrusia")]);
        CfdiPais::create(["code" => "MMR", "name" => Str::upper("Myanmar")]);
        CfdiPais::create(["code" => "BOL", "name" => Str::upper("Bolivia")]);
        CfdiPais::create(["code" => "BIH", "name" => Str::upper("Bosnia y Herzegovina")]);
        CfdiPais::create(["code" => "BWA", "name" => Str::upper("Botsuana")]);
        CfdiPais::create(["code" => "BRA", "name" => Str::upper("Brasil")]);
        CfdiPais::create(["code" => "BRN", "name" => Str::upper("Brunéi Darussalam")]);
        CfdiPais::create(["code" => "BGR", "name" => Str::upper("Bulgaria")]);
        CfdiPais::create(["code" => "BFA", "name" => Str::upper("Burkina Faso")]);
        CfdiPais::create(["code" => "BDI", "name" => Str::upper("Burundi")]);
        CfdiPais::create(["code" => "BTN", "name" => Str::upper("Bután")]);
        CfdiPais::create(["code" => "CPV", "name" => Str::upper("Cabo Verde")]);
        CfdiPais::create(["code" => "KHM", "name" => Str::upper("Camboya")]);
        CfdiPais::create(["code" => "CMR", "name" => Str::upper("Camerún")]);
        CfdiPais::create(["code" => "CAN", "name" => Str::upper("Canadá")]);
        CfdiPais::create(["code" => "QAT", "name" => Str::upper("Catar")]);
        CfdiPais::create(["code" => "BES", "name" => Str::upper("Bonaire, San Eustaquio y Saba")]);
        CfdiPais::create(["code" => "TCD", "name" => Str::upper("Chad")]);
        CfdiPais::create(["code" => "CHL", "name" => Str::upper("Chile")]);
        CfdiPais::create(["code" => "CHN", "name" => Str::upper("China")]);
        CfdiPais::create(["code" => "CYP", "name" => Str::upper("Chipre")]);
        CfdiPais::create(["code" => "COL", "name" => Str::upper("Colombia")]);
        CfdiPais::create(["code" => "COM", "name" => Str::upper("Comoras")]);
        CfdiPais::create(["code" => "PRK", "name" => Str::upper("Corea del Norte")]);
        CfdiPais::create(["code" => "KOR", "name" => Str::upper("Corea del Sur")]);
        CfdiPais::create(["code" => "CIV", "name" => Str::upper("Côte d'Ivoire")]);
        CfdiPais::create(["code" => "CRI", "name" => Str::upper("Costa Rica")]);
        CfdiPais::create(["code" => "HRV", "name" => Str::upper("Croacia")]);
        CfdiPais::create(["code" => "CUB", "name" => Str::upper("Cuba")]);
        CfdiPais::create(["code" => "CUW", "name" => Str::upper("Curaçao")]);
        CfdiPais::create(["code" => "DNK", "name" => Str::upper("Dinamarca")]);
        CfdiPais::create(["code" => "DMA", "name" => Str::upper("Dominica")]);
        CfdiPais::create(["code" => "ECU", "name" => Str::upper("Ecuador")]);
        CfdiPais::create(["code" => "EGY", "name" => Str::upper("Egipto")]);
        CfdiPais::create(["code" => "SLV", "name" => Str::upper("El Salvador")]);
        CfdiPais::create(["code" => "ARE", "name" => Str::upper("Emiratos Árabes Unidos")]);
        CfdiPais::create(["code" => "ERI", "name" => Str::upper("Eritrea")]);
        CfdiPais::create(["code" => "SVK", "name" => Str::upper("Eslovaquia")]);
        CfdiPais::create(["code" => "SVN", "name" => Str::upper("Eslovenia")]);
        CfdiPais::create(["code" => "ESP", "name" => Str::upper("España")]);
        CfdiPais::create(["code" => "USA", "name" => Str::upper("Estados Unidos")]);
        CfdiPais::create(["code" => "EST", "name" => Str::upper("Estonia")]);
        CfdiPais::create(["code" => "ETH", "name" => Str::upper("Etiopía")]);
        CfdiPais::create(["code" => "PHL", "name" => Str::upper("Filipinas")]);
        CfdiPais::create(["code" => "FIN", "name" => Str::upper("Finlandia")]);
        CfdiPais::create(["code" => "FJI", "name" => Str::upper("Fiyi")]);
        CfdiPais::create(["code" => "FRA", "name" => Str::upper("Francia")]);
        CfdiPais::create(["code" => "GAB", "name" => Str::upper("Gabón")]);
        CfdiPais::create(["code" => "GMB", "name" => Str::upper("Gambia")]);
        CfdiPais::create(["code" => "GEO", "name" => Str::upper("Georgia")]);
        CfdiPais::create(["code" => "GHA", "name" => Str::upper("Ghana")]);
        CfdiPais::create(["code" => "GIB", "name" => Str::upper("Gibraltar")]);
        CfdiPais::create(["code" => "GRD", "name" => Str::upper("Granada")]);
        CfdiPais::create(["code" => "GRC", "name" => Str::upper("Grecia")]);
        CfdiPais::create(["code" => "GRL", "name" => Str::upper("Groenlandia")]);
        CfdiPais::create(["code" => "GLP", "name" => Str::upper("Guadalupe")]);
        CfdiPais::create(["code" => "GUM", "name" => Str::upper("Guam")]);
        CfdiPais::create(["code" => "GTM", "name" => Str::upper("Guatemala")]);
        CfdiPais::create(["code" => "GUF", "name" => Str::upper("Guayana Francesa")]);
        CfdiPais::create(["code" => "GGY", "name" => Str::upper("Guernsey")]);
        CfdiPais::create(["code" => "GIN", "name" => Str::upper("Guinea")]);
        CfdiPais::create(["code" => "GNB", "name" => Str::upper("Guinea-Bisáu")]);
        CfdiPais::create(["code" => "GNQ", "name" => Str::upper("Guinea Ecuatorial")]);
        CfdiPais::create(["code" => "GUY", "name" => Str::upper("Guyana")]);
        CfdiPais::create(["code" => "HTI", "name" => Str::upper("Haití")]);
        CfdiPais::create(["code" => "HND", "name" => Str::upper("Honduras")]);
        CfdiPais::create(["code" => "HKG", "name" => Str::upper("Hong Kong")]);
        CfdiPais::create(["code" => "HUN", "name" => Str::upper("Hungría")]);
        CfdiPais::create(["code" => "IND", "name" => Str::upper("India")]);
        CfdiPais::create(["code" => "IDN", "name" => Str::upper("Indonesia")]);
        CfdiPais::create(["code" => "IRQ", "name" => Str::upper("Irak")]);
        CfdiPais::create(["code" => "IRN", "name" => Str::upper("Irán")]);
        CfdiPais::create(["code" => "IRL", "name" => Str::upper("Irlanda")]);
        CfdiPais::create(["code" => "BVT", "name" => Str::upper("Isla Bouvet")]);
        CfdiPais::create(["code" => "IMN", "name" => Str::upper("Isla de Man")]);
        CfdiPais::create(["code" => "CXR", "name" => Str::upper("Isla de Navidad")]);
        CfdiPais::create(["code" => "NFK", "name" => Str::upper("Isla Norfolk")]);
        CfdiPais::create(["code" => "ISL", "name" => Str::upper("Islandia")]);
        CfdiPais::create(["code" => "CYM", "name" => Str::upper("Islas Caimán")]);
        CfdiPais::create(["code" => "CCK", "name" => Str::upper("Islas Cocos")]);
        CfdiPais::create(["code" => "COK", "name" => Str::upper("Islas Cook")]);
        CfdiPais::create(["code" => "FRO", "name" => Str::upper("Islas Feroe")]);
        CfdiPais::create(["code" => "SGS", "name" => Str::upper("Georgia del sur y las islas sandwich del sur")]);
        CfdiPais::create(["code" => "HMD", "name" => Str::upper("Isla Heard e Islas McDonald")]);
        CfdiPais::create(["code" => "FLK", "name" => Str::upper("Islas Malvinas")]);
        CfdiPais::create(["code" => "MNP", "name" => Str::upper("Islas Marianas del Norte")]);
        CfdiPais::create(["code" => "MHL", "name" => Str::upper("Islas Marshall")]);
        CfdiPais::create(["code" => "PCN", "name" => Str::upper("Pitcairn")]);
        CfdiPais::create(["code" => "SLB", "name" => Str::upper("Islas Salomón")]);
        CfdiPais::create(["code" => "TCA", "name" => Str::upper("Islas Turcas y Caicos")]);
        CfdiPais::create(["code" => "UMI", "name" => Str::upper("Islas de Ultramar Menores de Estados Unidos")]);
        CfdiPais::create(["code" => "VGB", "name" => Str::upper("Islas Vírgenes (Británicas)")]);
        CfdiPais::create(["code" => "VIR", "name" => Str::upper("Islas Vírgenes (EE.UU.)")]);
        CfdiPais::create(["code" => "ISR", "name" => Str::upper("Israel")]);
        CfdiPais::create(["code" => "ITA", "name" => Str::upper("Italia")]);
        CfdiPais::create(["code" => "JAM", "name" => Str::upper("Jamaica")]);
        CfdiPais::create(["code" => "JPN", "name" => Str::upper("Japón")]);
        CfdiPais::create(["code" => "JEY", "name" => Str::upper("Jersey")]);
        CfdiPais::create(["code" => "JOR", "name" => Str::upper("Jordania")]);
        CfdiPais::create(["code" => "KAZ", "name" => Str::upper("Kazajistán")]);
        CfdiPais::create(["code" => "KEN", "name" => Str::upper("Kenia")]);
        CfdiPais::create(["code" => "KGZ", "name" => Str::upper("Kirguistán")]);
        CfdiPais::create(["code" => "KIR", "name" => Str::upper("Kiribati")]);
        CfdiPais::create(["code" => "KWT", "name" => Str::upper("Kuwait")]);
        CfdiPais::create(["code" => "LAO", "name" => Str::upper("Lao")]);
        CfdiPais::create(["code" => "LSO", "name" => Str::upper("Lesoto")]);
        CfdiPais::create(["code" => "LVA", "name" => Str::upper("Letonia")]);
        CfdiPais::create(["code" => "LBN", "name" => Str::upper("Líbano")]);
        CfdiPais::create(["code" => "LBR", "name" => Str::upper("Liberia")]);
        CfdiPais::create(["code" => "LBY", "name" => Str::upper("Libia")]);
        CfdiPais::create(["code" => "LIE", "name" => Str::upper("Liechtenstein")]);
        CfdiPais::create(["code" => "LTU", "name" => Str::upper("Lituania")]);
        CfdiPais::create(["code" => "LUX", "name" => Str::upper("Luxemburgo")]);
        CfdiPais::create(["code" => "MAC", "name" => Str::upper("Macao")]);
        CfdiPais::create(["code" => "MDG", "name" => Str::upper("Madagascar")]);
        CfdiPais::create(["code" => "MYS", "name" => Str::upper("Malasia")]);
        CfdiPais::create(["code" => "MWI", "name" => Str::upper("Malaui")]);
        CfdiPais::create(["code" => "MDV", "name" => Str::upper("Maldivas")]);
        CfdiPais::create(["code" => "MLI", "name" => Str::upper("Malí")]);
        CfdiPais::create(["code" => "MLT", "name" => Str::upper("Malta")]);
        CfdiPais::create(["code" => "MAR", "name" => Str::upper("Marruecos")]);
        CfdiPais::create(["code" => "MTQ", "name" => Str::upper("Martinica")]);
        CfdiPais::create(["code" => "MUS", "name" => Str::upper("Mauricio")]);
        CfdiPais::create(["code" => "MRT", "name" => Str::upper("Mauritania")]);
        CfdiPais::create(["code" => "MYT", "name" => Str::upper("Mayotte")]);
        CfdiPais::create(["code" => "MEX", "name" => Str::upper("México")]);
        CfdiPais::create(["code" => "FSM", "name" => Str::upper("Micronesia")]);
        CfdiPais::create(["code" => "MDA", "name" => Str::upper("Moldavia")]);
        CfdiPais::create(["code" => "MCO", "name" => Str::upper("Mónaco")]);
        CfdiPais::create(["code" => "MNG", "name" => Str::upper("Mongolia")]);
        CfdiPais::create(["code" => "MNE", "name" => Str::upper("Montenegro")]);
        CfdiPais::create(["code" => "MSR", "name" => Str::upper("Montserrat")]);
        CfdiPais::create(["code" => "MOZ", "name" => Str::upper("Mozambique")]);
        CfdiPais::create(["code" => "NAM", "name" => Str::upper("Namibia")]);
        CfdiPais::create(["code" => "NRU", "name" => Str::upper("Nauru")]);
        CfdiPais::create(["code" => "NPL", "name" => Str::upper("Nepal")]);
        CfdiPais::create(["code" => "NIC", "name" => Str::upper("Nicaragua")]);
        CfdiPais::create(["code" => "NER", "name" => Str::upper("Níger")]);
        CfdiPais::create(["code" => "NGA", "name" => Str::upper("Nigeria")]);
        CfdiPais::create(["code" => "NIU", "name" => Str::upper("Niue")]);
        CfdiPais::create(["code" => "NOR", "name" => Str::upper("Noruega")]);
        CfdiPais::create(["code" => "NCL", "name" => Str::upper("Nueva Caledonia")]);
        CfdiPais::create(["code" => "NZL", "name" => Str::upper("Nueva Zelanda")]);
        CfdiPais::create(["code" => "OMN", "name" => Str::upper("Omán")]);
        CfdiPais::create(["code" => "NLD", "name" => Str::upper("Países Bajos")]);
        CfdiPais::create(["code" => "PAK", "name" => Str::upper("Pakistán")]);
        CfdiPais::create(["code" => "PLW", "name" => Str::upper("Palaos")]);
        CfdiPais::create(["code" => "PSE", "name" => Str::upper("Palestina")]);
        CfdiPais::create(["code" => "PAN", "name" => Str::upper("Panamá")]);
        CfdiPais::create(["code" => "PNG", "name" => Str::upper("Papúa Nueva Guinea")]);
        CfdiPais::create(["code" => "PRY", "name" => Str::upper("Paraguay")]);
        CfdiPais::create(["code" => "PER", "name" => Str::upper("Perú")]);
        CfdiPais::create(["code" => "PYF", "name" => Str::upper("Polinesia Francesa")]);
        CfdiPais::create(["code" => "POL", "name" => Str::upper("Polonia")]);
        CfdiPais::create(["code" => "PRT", "name" => Str::upper("Portugal")]);
        CfdiPais::create(["code" => "PRI", "name" => Str::upper("Puerto Rico")]);
        CfdiPais::create(["code" => "GBR", "name" => Str::upper("Reino Unido")]);
        CfdiPais::create(["code" => "CAF", "name" => Str::upper("República Centroafricana")]);
        CfdiPais::create(["code" => "CZE", "name" => Str::upper("República Checa")]);
        CfdiPais::create(["code" => "MKD", "name" => Str::upper("Macedonia")]);
        CfdiPais::create(["code" => "COG", "name" => Str::upper("Congo")]);
        CfdiPais::create(["code" => "COD", "name" => Str::upper("Congo")]);
        CfdiPais::create(["code" => "DOM", "name" => Str::upper("República Dominicana")]);
        CfdiPais::create(["code" => "REU", "name" => Str::upper("Reunión")]);
        CfdiPais::create(["code" => "RWA", "name" => Str::upper("Ruanda")]);
        CfdiPais::create(["code" => "ROU", "name" => Str::upper("Rumania")]);
        CfdiPais::create(["code" => "RUS", "name" => Str::upper("Rusia, Federación de")]);
        CfdiPais::create(["code" => "ESH", "name" => Str::upper("Sahara Occidental")]);
        CfdiPais::create(["code" => "WSM", "name" => Str::upper("Samoa")]);
        CfdiPais::create(["code" => "ASM", "name" => Str::upper("Samoa Americana")]);
        CfdiPais::create(["code" => "BLM", "name" => Str::upper("San Bartolomé")]);
        CfdiPais::create(["code" => "KNA", "name" => Str::upper("San Cristóbal y Nieves")]);
        CfdiPais::create(["code" => "SMR", "name" => Str::upper("San Marino")]);
        CfdiPais::create(["code" => "MAF", "name" => Str::upper("San Martín")]);
        CfdiPais::create(["code" => "SPM", "name" => Str::upper("San Pedro y Miquelón")]);
        CfdiPais::create(["code" => "VCT", "name" => Str::upper("San Vicente y las Granadinas")]);
        CfdiPais::create(["code" => "SHN", "name" => Str::upper("Santa Helena, Ascensión y Tristán de Acuña")]);
        CfdiPais::create(["code" => "LCA", "name" => Str::upper("Santa Lucía")]);
        CfdiPais::create(["code" => "STP", "name" => Str::upper("Santo Tomé y Príncipe")]);
        CfdiPais::create(["code" => "SEN", "name" => Str::upper("Senegal")]);
        CfdiPais::create(["code" => "SRB", "name" => Str::upper("Serbia")]);
        CfdiPais::create(["code" => "SYC", "name" => Str::upper("Seychelles")]);
        CfdiPais::create(["code" => "SLE", "name" => Str::upper("Sierra leona")]);
        CfdiPais::create(["code" => "SGP", "name" => Str::upper("Singapur")]);
        CfdiPais::create(["code" => "SXM", "name" => Str::upper("Sint Maarten")]);
        CfdiPais::create(["code" => "SYR", "name" => Str::upper("Siria")]);
        CfdiPais::create(["code" => "SOM", "name" => Str::upper("Somalia")]);
        CfdiPais::create(["code" => "LKA", "name" => Str::upper("Sri Lanka")]);
        CfdiPais::create(["code" => "SWZ", "name" => Str::upper("Suazilandia")]);
        CfdiPais::create(["code" => "ZAF", "name" => Str::upper("Sudáfrica")]);
        CfdiPais::create(["code" => "SDN", "name" => Str::upper("Sudán")]);
        CfdiPais::create(["code" => "SSD", "name" => Str::upper("Sudán del Sur")]);
        CfdiPais::create(["code" => "SWE", "name" => Str::upper("Suecia")]);
        CfdiPais::create(["code" => "CHE", "name" => Str::upper("Suiza")]);
        CfdiPais::create(["code" => "SUR", "name" => Str::upper("Surinam")]);
        CfdiPais::create(["code" => "SJM", "name" => Str::upper("Svalbard y Jan Mayen")]);
        CfdiPais::create(["code" => "THA", "name" => Str::upper("Tailandia")]);
        CfdiPais::create(["code" => "TWN", "name" => Str::upper("Taiwán")]);
        CfdiPais::create(["code" => "TZA", "name" => Str::upper("Tanzania")]);
        CfdiPais::create(["code" => "TJK", "name" => Str::upper("Tayikistán")]);
        CfdiPais::create(["code" => "IOT", "name" => Str::upper("Territorio Británico del Océano Índico")]);
        CfdiPais::create(["code" => "ATF", "name" => Str::upper("Territorios Australes Franceses")]);
        CfdiPais::create(["code" => "TLS", "name" => Str::upper("Timor-Leste")]);
        CfdiPais::create(["code" => "TGO", "name" => Str::upper("Togo")]);
        CfdiPais::create(["code" => "TKL", "name" => Str::upper("Tokelau")]);
        CfdiPais::create(["code" => "TON", "name" => Str::upper("Tonga")]);
        CfdiPais::create(["code" => "TTO", "name" => Str::upper("Trinidad y Tobago")]);
        CfdiPais::create(["code" => "TUN", "name" => Str::upper("Túnez")]);
        CfdiPais::create(["code" => "TKM", "name" => Str::upper("Turkmenistán")]);
        CfdiPais::create(["code" => "TUR", "name" => Str::upper("Turquía")]);
        CfdiPais::create(["code" => "TUV", "name" => Str::upper("Tuvalu")]);
        CfdiPais::create(["code" => "UKR", "name" => Str::upper("Ucrania")]);
        CfdiPais::create(["code" => "UGA", "name" => Str::upper("Uganda")]);
        CfdiPais::create(["code" => "URY", "name" => Str::upper("Uruguay")]);
        CfdiPais::create(["code" => "UZB", "name" => Str::upper("Uzbekistán")]);
        CfdiPais::create(["code" => "VUT", "name" => Str::upper("Vanuatu")]);
        CfdiPais::create(["code" => "VAT", "name" => Str::upper("Santa Sede")]);
        CfdiPais::create(["code" => "VEN", "name" => Str::upper("República Bolivariana de Venezuela")]);
        CfdiPais::create(["code" => "VNM", "name" => Str::upper("Viet Nam")]);
        CfdiPais::create(["code" => "WLF", "name" => Str::upper("Wallis y Futuna")]);
        CfdiPais::create(["code" => "YEM", "name" => Str::upper("Yemen")]);
        CfdiPais::create(["code" => "DJI", "name" => Str::upper("Yibuti")]);
        CfdiPais::create(["code" => "ZMB", "name" => Str::upper("Zambia")]);
        CfdiPais::create(["code" => "ZWE", "name" => Str::upper("Zimbabue")]);
        CfdiPais::create(["code" => "ZZZ", "name" => Str::upper("Países no declarados")]);
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
