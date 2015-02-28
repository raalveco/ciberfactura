<?php
    namespace Ciberfactura;

    class CfdiTimbrador{
        private $namespace = 'http://micommerce.mx';

        //TESTING
        //private $url = 'http://app.facturadorelectronico.com/pruebastimbradofe/timbrado.asmx?WSDL';
        //private $id_usuario_global = 1; //idusuario global.
        //private $usuario = "test";
        //private $password = "TEST";

        //PRODUCTION
        private $url = 'https://cfdi.facturadorelectronico.com/wstimbrado/timbrado.asmx?WSDL';
        private $id_usuario_global = 1; //idusuario global.
        private $usuario = "RamLozcTrx";
        private $password = "VrGY3Brad";

        private $cliente = null;

        public function __construct(){
            $this->cliente = new nusoap_client($this->url,'soap');
            $this->cliente->soap_defencoding = "UTF-8";
            $this->cliente->decode_utf8 = false;

            if ($error = $this->cliente->getError()) {
                return null;
            }
        }

        public static function timbrado($xml_base){
            $facturador = new WsFacturadorElectronico();

            if(file_exists($xml_base)){

                $dom = new DOMDocument();
                $dom->load($xml_base);

                $xml = trim($dom->saveXML());

                //obtenerTimbrado
                $parametros = array(
                    'CFDIcliente' => $xml,
                    'Usuario' => $facturador->usuario,
                    'password' => $facturador->password
                );

                $resultado = $facturador->cliente->call('obtenerTimbrado',$parametros,$facturador->namespace);

                return $resultado;
            }

            return false;
        }

        public static function cancelacion($xml){
            $facturador = new WsFacturadorElectronico();

            //Cancelacion
            $parametros = array(
                'xmlCancelacion' => $xml,
                'usuario' => $facturador->usuario,
                'password' => $facturador->password
            );

            $resultado = $facturador->cliente->call('cancelarComprobante',$parametros,$facturador->namespace);

            return $resultado;
        }

        public static function cancelacionPFX($rfc, $uuid, $pfx, $pfx_pass){
            $facturador = new WsFacturadorElectronico();

            $rawFile = fread(fopen($pfx, "r"), filesize($pfx));
            $pfx_base64 = base64_encode($rawFile);

            //echo $rfc."<br><br>";
            //echo $pfx."<br><br>";
            //echo $facturador->usuario."<br><br>";
            //echo $facturador->password."<br><br>";
            //echo $pfx_pass."<br><br>";
            //echo $pfx_base64."<br><br>";

            //Cancelacion
            $parametros = array(
                'usuario' => $facturador->usuario,
                'password' => $facturador->password,
                'uuids' => array($uuid),
                'pfx' => $pfx_base64,
                'passwordPfx' => $pfx_pass,
                'rfc' => $rfc,
            );

            $resultado = $facturador->cliente->call('EnviarCancelacionPFX',$parametros);

            return $resultado;
        }
    }