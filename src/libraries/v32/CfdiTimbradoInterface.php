<?php

namespace Raalveco\Ciberfactura\Libraries\V32;

interface CfdiTimbradoInterface{
    public function timbrar($xml);
    public function cancelar($uuid);
}