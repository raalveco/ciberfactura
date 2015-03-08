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
    'production' => true,
    'rfc' => 'VECR8307073J1',
    'cer' => '00001000000302642746.cer',
    'key' => '00001000000302642746.key',
    'clave_privada' => 'Ramiro07',
    'pac' => array(
        'url_autentificar' => 'https://cfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
        'url_timbrar' => 'https://cfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
        'url_cancelar' => 'https://cfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
        'usuario' => 'demo',        //Cambiarán cuando se contrate el Servicio de Timbres
        'password' => '123456789',  //Cambiarán cuando se contrate el Servicio de Timbres
    ),
    'pac_test' => array(
        'url_autentificar' => 'https://pruebascfdi.smartweb.com.mx/Autenticacion/wsAutenticacion.asmx?wsdl',
        'url_timbrar' => 'https://pruebascfdi.smartweb.com.mx/Timbrado/wsTimbrado.asmx?wsdl',
        'url_cancelar' => 'https://pruebascfdi.smartweb.com.mx/Cancelacion/wsCancelacion.asmx?wsdl',
        'usuario' => 'demo',
        'password' => '123456789',
    ),
    'path_xmls' => public_path().'/cfdis',
    'logo' => 'logotipo.png',
);