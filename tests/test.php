<?php

    require_once __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/connection.php';

    use Ciberfactura\Cfdi;

    echo Cfdi::test();

    $emisor = new CfdiEmisor();

?>