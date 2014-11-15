<?php
namespace Ciberfactura;

use CfdiComplemento;
use CfdiConcepto;
use CfdiEmisor;
use CfdiFactura;
use CfdiImpuesto;
use CfdiReceptor;
use CfdiRegimen;
use CfdiSucursal;

class Cfdi{
    public static function test()
    {
        $factura = new CfdiFactura();

        $factura->serie = "AX";
        $factura->folio = 3894;

        $factura->total = 116.00;

        $factura->save();
    }
}