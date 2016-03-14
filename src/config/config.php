<?php
/**
 * Created by PhpStorm.
 * User: Galeno
 * Date: 12/03/2016
 * Time: 07:51 PM
 */

return array(
    'production' => env('CFDI_PRODUCTION', false),
    'certificate' => array(
        'cer' => env('CFDI_CERTIFICATE_CER', 'config/packages/raalveco/ciberfactura/certificate/aad990814bp7_1210261233s.cer'),
        'key' => env('CFDI_CERTIFICATE_KEY', 'config/packages/raalveco/ciberfactura/certificate/aad990814bp7_1210261233s.key'),
        'password' => env('CFDI_CERTIFICATE_PRIVATE_KEY', '12345678a')
    ),
    'wsdl' => array(
        'sandbox' => array(
            'autentificacion' => 'http://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
            'timbrado' => 'http://pruebascfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
            'cancelacion' => 'http://pruebascfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
            'usuario' => 'demo',
            'password' => '123456789',
        ),
        'production' => array(
            'autentificacion' => 'https://cfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
            'timbrado' => 'https://cfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
            'cancelacion' => 'https://cfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
            'usuario' => env('SMART_WEB_USER', ''),
            'password' => env('SMART_WEB_PASSWORD', ''),
        )
    ),
    'path_xmls' => public_path().'/cfdis'
);