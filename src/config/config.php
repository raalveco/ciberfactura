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
    'path' => public_path().'/cfdis'
];