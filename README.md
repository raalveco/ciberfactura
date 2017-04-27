# Ciberfactura 2.0 - Facturación Electrónica en México

Libreria que simplifica el proceso de creación y timbrado de CFDIs v3.3

## Instalación

Para iniciar la instalación de la libreria es necesario agregar la dependencia en nuestro composer.json en la raíz de Laravel.

```js
{
    "require": {
        "raalveco/ciberfactura": "2.0.*"
    }
}
```

## Laravel 5.4

Registrar el siguiente Service Provider. y Alias

```php
// config/app.php

'providers' => [
    Raalveco\Ciberfactura\CiberfacturaServiceProvider::class,
];

'aliases' => [
    'Cfdi' => Raalveco\Ciberfactura\Facades\Cfdi::class,
];
```

Enseguida, publicar la configuración por defecto.

```bash
php artisan vendor:publish
```

Este comando además de crear el archivo de configuración `config/packages/raalveco/ciberfactura/config.php`, creará un grupo de archivos con las migrations para crear las tablas necesarias para la creación de cfdis.

Para que la configuración funcione de manera adecuada debemos definir las variables de ambiente en nuestro archivo .env con sus apropiados valores.

Esta libreria servira para emitir facturas con Smarter Web, el cual es un proveedor autorizado de certificación del SAT.

## Migrations

Antes de probar el funcionamiento de la libreria, es necesario ejecutar los migrations que crearán las tablas donde se almacenan los CFDIs.

```bash
php artisan migrate
```

## Código de Ejemplo

```php
    $factura = CfdiFactura::create(
        array(
            "serie" => "A",
            "folio" => 234,
            "fecha" => date("Y-m-d H:i:s"),
            "subTotal" => 200,
            "total" => 232.0
        )
    );

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

    $factura->addReceptor(
        "PEGJ801021H4K",
        "Juan Pérez González",
        "Juarez",
        "56",
        "3A",
        "Centro",
        "Guadalajara",
        "Guadalajara",
        "Jalisco",
        "Mexico",
        "44460"
    );

    $factura->addConcepto(
        1,
        "Año",
        "Servicio de Facturación Electrónica",
        100.00,
        100.00
    );

    $factura->addConcepto(
        1,
        "Año",
        "Servicio de Timbrado de Facturas Electrónicas",
        100.00,
        100.00
    );

    $factura->addImpuesto(
        "Traslado",
        "IVA",
        16.00,
        32.00
    );

    $factura->addSucursal(
        "Av. Revolución",
        "212",
        "",
        "Centro",
        "Ameca",
        "Ameca",
        "Jalisco",
        "Mexico",
        "46600"
    );

    $factura->addRegimen("Regimen General para Personas Morales");

    Cfdi::loadCfdi($factura);
    $sello = Cfdi::sellar();
    $uuid = Cfdi::timbrar();

    Cfdi::guardar();

    $xml = Cfdi::xml();

```
