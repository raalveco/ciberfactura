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
    protected $version = "3.2";

    public function __construct($subtotal, $total){

    }

    public static function test()
    {
        $factura = new CfdiFactura();

        $factura->serie = "AX";
        $factura->folio = 3894;

        $factura->total = 116.00;

        $factura->save();
    }
}