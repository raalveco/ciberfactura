<?php

return array(
    'production' => env('CFDI_PRODUCTION', false),
    'certificate' => array(
        'cer' => env('CFDI_CERTIFICATE_CER', 'config/packages/raalveco/ciberfactura/certificate/CSD01_AAA010101AAA.cer'),
        'key' => env('CFDI_CERTIFICATE_KEY', 'config/packages/raalveco/ciberfactura/certificate/CSD01_AAA010101AAA.key'),
        'password' => env('CFDI_CERTIFICATE_PRIVATE_KEY', '12345678a')
    ),
    'wsdl' => array(
        'sandbox' => array(
            'endpoint' => 'http://services.test.sw.com.mx',
            'usuario' => 'demo',
            'password' => '12345678A',
        ),
        'production' => array(
            'endpoint' => 'http://services.sw.com.mx',
            'usuario' => env('SMART_WEB_USER', ''),
            'password' => env('SMART_WEB_PASSWORD', ''),
        )
    ),
    'path_xmls' => public_path().'/cfdis'
);