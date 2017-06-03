<?php

return [
    'production' => env('CFDI_PRODUCTION', false),
    'certificate' => [
        'sandbox' => [
            'cer' => 'config/packages/raalveco/ciberfactura/certificates/CSD01_AAA010101AAA.cer',
            'key' => 'config/packages/raalveco/ciberfactura/certificates/CSD01_AAA010101AAA.key',
            'password' => '12345678a'
        ],
        'production' => [
            'cer' => env('CFDI_CERTIFICATE_CER', false),
            'key' => env('CFDI_CERTIFICATE_KEY', false),
            'password' => env('CFDI_CERTIFICATE_PRIVATE_KEY', false)
        ]
    ],
    'wsdl' => [
        'sandbox' => [
            'endpoint' => 'http://services.test.sw.com.mx',
            'usuario' => 'demo',
            'password' => '12345678A',
        ],
        'production' => [
            'endpoint' => 'http://services.sw.com.mx',
            'usuario' => env('SMART_WEB_USER', ''),
            'password' => env('SMART_WEB_PASSWORD', ''),
        ]
    ],
    'v32' => [
        'sw_production' => array(
            'url_autentificar' => 'https://cfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
            'url_timbrar' => 'https://cfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
            'url_cancelar' => 'https://cfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
            'usuario' => env('SMART_WEB_USER', 'demo'),
            'password' => env('SMART_WEB_PASSWORD', '123456789'),
        ),
        'sw_test' => array(
            'url_autentificar' => 'http://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
            'url_timbrar' => 'http://pruebascfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
            'url_cancelar' => 'http://pruebascfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
            'usuario' => 'demo',
            'password' => '123456789',
        )
    ],
    'path' => public_path().'/cfdis'
];