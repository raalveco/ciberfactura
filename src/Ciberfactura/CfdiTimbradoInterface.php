<?php

namespace Ciberfactura;

interface CfdiTimbradoInterface{
    public function timbrar($xml);
    public function cancelar($uuid);
}