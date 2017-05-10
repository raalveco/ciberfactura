# Ciberfactura 2.0 - Facturación Electrónica en México

Libreria que simplifica el proceso de creación y timbrado de CFDIs v3.3

## Instalación

Para iniciar la instalación de la libreria es necesario agregar la dependencia en nuestro composer.json en la raíz de Laravel.

```js
{
    "require": {
        "raalveco/ciberfactura": "2.0.0-beta.3"
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
php artisan vendor:publish --provider="Raalveco\Ciberfactura\CiberfacturaServiceProvider"
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
    DB::beginTransaction();

    $cfdi_factura = CfdiFactura::create([
        'version' => 3.3,
        'serie' => 'AS',
        'folio' => '3972',
        'fecha' => str_replace(" ", "T", date("Y-m-d H:i:s")),
        'forma_pago' => "03",
        'sub_total' => 1000,
        'descuento' => 0,
        'moneda' => 'MXN',
        'total' => 1000,
        'tipo_de_comprobante' => 'I',
        'metodo_pago' => 'PUE',
        'lugar_expedicion' => '46600',
        'condiciones_de_pago' => 'Condiciones No Definidas'
    ]);

    $cfdi_factura->addEmisor([
        'rfc' => 'AAA010101AAA',
        'nombre' => 'ACCEM SERVICIOS EMPRESARIALES SC',
        'regimen_fiscal' => '601'
    ]);

    $cfdi_factura->addReceptor([
        'rfc' => 'VECR8307073J1',
        'nombre' => 'Ramiro Alonso Vera Contreras',
        'residencia_fiscal' => 'MEX',
        'num_reg_id_trib' => '',
        'uso_cfdi' => 'G03'
    ]);

    $cfdi_concepto = $cfdi_factura->addConcepto([
        'cfdi_id' => $cfdi_factura->id,
        'clave_prod_serv' => '10151810',
        'no_identificacion' => '',
        'cantidad' => 5,
        'clave_unidad' => 'E49',
        'unidad' => 'Litro',
        'descripcion' => 'Concepto de Prueba 1',
        'valor_unitario' => 100.00,
        'importe' => 500.00,
        'descuento' => 0.00
    ]);

    $cfdi_concepto->addImpuesto([
        'cfdi_id' => $cfdi_factura->id,
        'type' => 'retencion',
        'base' => 500.00,
        'impuesto' => '001',
        'tipo_factor' => 'Tasa',
        'tasa_o_cuota' => 0.1600,
        'importe' => 80.00
    ]);

    $cfdi_concepto = $cfdi_factura->addConcepto([
        'cfdi_id' => $cfdi_factura->id,
        'clave_prod_serv' => '10151810',
        'no_identificacion' => '',
        'cantidad' => 5,
        'clave_unidad' => 'E49',
        'unidad' => 'Litro',
        'descripcion' => 'Concepto de Prueba 2',
        'valor_unitario' => 100.00,
        'importe' => 500.00,
        'descuento' => 0.00
    ]);

    $cfdi_concepto->addImpuesto([
        'type' => 'traslado',
        'base' => 500.00,
        'impuesto' => '002',
        'tipo_factor' => 'Tasa',
        'tasa_o_cuota' => 0.1600,
        'importe' => 80.00
    ]);

    $cfdi = new Cfdi();
    $cfdi->setTimbrador(new CfdiTimbrador($cfdi->rfc, $cfdi->certificate, $cfdi->production));

    $cfdi->load($cfdi_factura);

    $sello = $cfdi->sellar();

    $uuid = $cfdi->timbrar();

    $xml = $cfdi->xml();

    DB::commit();

```
