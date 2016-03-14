<?php

    namespace Raalveco\Ciberfactura\Libraries;

    interface CfdiTimbradoInterface{
        public function timbrar($xml);
        public function cancelar($uuid);
    }