<?php
/**
 * Part of the Ciberfactura package.
 *
 * @package    Ciberfactura
 * @version    0.1.0
 * @author     raalveco
 * @license    MIT License
 * @copyright  (c) 2014 - 2015
 * @link       http://www.ciberfactura.com.mx
 */

return array(
    'production' => false,
    'rfc' => 'AAD990814BP7',
    'emisor' => array(
        'rfc' => 'AAD990814BP7',
        'razon_social' => 'EMPRESA PRUEBAS SA DE CV',
        'calle' => 'Avenida Américas',
        'no_interior' => '334',
        'no_exterior' => '302',
        'colonia' => 'Altamira',
        'localidad' => 'Zapopan',
        'municipio' => 'Zapopan',
        'estado' => 'Jalisco',
        'pais' => 'México',
        'cpostal' => '44690',

    ),
    'regimenes' => array('Simplificado'),
    'cer' => 'AAD990814BP7/aad990814bp7_1210261233s.cer',
    'key' => 'AAD990814BP7/aad990814bp7_1210261233s.key',
    'clave_privada' => '12345678a',
    'pac' => array(
        'url_autentificar' => 'https://cfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
        'url_timbrar' => 'https://cfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
        'url_cancelar' => 'https://cfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
        'usuario' => '',        //Cambiarán cuando se contrate el Servicio de Timbres
        'password' => '',  //Cambiarán cuando se contrate el Servicio de Timbres
    ),
    'pac_test' => array(
        'url_autentificar' => 'https://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
        'url_timbrar' => 'https://pruebascfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
        'url_cancelar' => 'https://pruebascfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
        'usuario' => 'demo',
        'password' => '123456789',
    ),
    'path_xmls' => public_path().'/cfdis'
);