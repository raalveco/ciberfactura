<?php
    namespace Raalveco\Ciberfactura\Libraries;

    class CfdiStamp{
        public $version, $uuid, $fecha_timbrado, $rfc, $sello_cfd, $no_certificado_sat, $sello_sat;

        public static $schema_location = 'http://www.sat.gob.mx/TimbreFiscalDigital http://www.sat.gob.mx/sitio_internet/cfd/TimbreFiscalDigital/TimbreFiscalDigitalv11.xsd';
        public static $xmlns_tfd = 'http://www.sat.gob.mx/TimbreFiscalDigital';
        public static $xmlns_xsi = 'http://www.w3.org/2001/XMLSchema-instance';

        public static function create($data){
            $stamp = new CfdiStamp();

            $stamp->version = $data["version"];
            $stamp->uuid = $data["uuid"];
            $stamp->rfc = $data["rfc"];
            $stamp->fecha_timbrado = $data["fecha_timbrado"];
            $stamp->sello_cfd = $data["sello_cfd"];
            $stamp->no_certificado_sat = $data["no_certificado_sat"];
            $stamp->sello_sat = $data["sello_sat"];

            return $stamp;
        }
    }