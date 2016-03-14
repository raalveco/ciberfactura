<?php
/**
 * Created by PhpStorm.
 * User: Galeno
 * Date: 12/03/2016
 * Time: 05:04 PM
 */

namespace Raalveco\Ciberfactura\Facades;
use Illuminate\Support\Facades\Facade;

class Cfdi extends Facade{
    protected static function getFacadeAccessor()
    {
        return 'cfdi';
    }
}