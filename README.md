ciberfactura
============

Alianses

'Cfdi' => 'Ciberfactura\Cfdi',

Migrations

php artisan migrate --package=raalveco/ciberfactura

Config

php artisan config:publish raalveco/ciberfactura

Example

    $factura = \Ciberfactura\CfdiFactura::create(array("serie" => "A", "folio" => 234, "fecha" => date("Y-m-d H:i:s",time()), "subTotal" => 200, "total" => 232.0));
    $factura = \Ciberfactura\CfdiFactura::find($factura->id);

    $factura->addEmisor(
        "AAD990814BP7",
        "EMPRESA PRUEBAS SA DE CV",
        "Independencia",
        "54",
        "",
        "Centro",
        "Ameca",
        "Ameca",
        "Jalisco",
        "Mexico",
        "46600"
    );
    $factura->addReceptor("PEGJ801021H4K","Juan Pérez González", "Juarez", "56","3A","Centro","Guadalajara","Guadalajara","Jalisco","Mexico","44460");
    $factura->addConcepto(1,"Ano","Servicio de Facturación Electrónica",100,100);
    $factura->addConcepto(1,"Ano","Servicio de Timbrado de Facturas Electrónicas",100,100);
    $factura->addImpuesto("Traslado","IVA",16,32.00);
    $factura->addSucursal("Av. Revolución", "212","","Centro","Ameca","Ameca","Jalisco","Mexico","46600");
    $factura->addRegimen("Simplificado");

    $cfdi = new Cfdi($factura);
    $cfdi->sellar();
    $cfdi->timbrar();
    $cfdi->guardar();