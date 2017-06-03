<?php
namespace Raalveco\Ciberfactura\Libraries\V32;

class CfdiData extends \Exception{
    public static $states = [
        "JAL" => "JALISCO",
        "SIN" => "SINALOA"
    ];

    public static $periodicities = [
        "04" => "QUINCENAL"
    ];

    public static $regimens = [
        "601" => "REGIMEN GENERAL PARA PERSONAS MORALES",
        //"601" => "General de Ley Personas Morales",
        "603" => "Personas Morales con Fines no Lucrativos",
        "605" => "Sueldos y Salarios e Ingresos Asimilados a Salarios"
    ];

    public static $contracts = [
        "01" => "BASE",
        //"01" => "Contrato de trabajo por tiempo indeterminado"
    ];

    public static $journals = [
        "01" => "TIEMPO COMPLETO",
        //"01" => "Diurna"
    ];

    public static $hours = [
        "01" => "DOBLES",
        "02" => "TRIPLES",
        "03" => "SIMPLES"
    ];

    public static function getStateCode($state){
        foreach(CfdiData::$states as $key => $value){
            if(strtoupper($state) == strtoupper($value)){
                return $key;
            }
        }
    }

    public static function getPeriodicityCode($periodicity){
        foreach(CfdiData::$periodicities as $key => $value){
            if(strtoupper($periodicity) == strtoupper($value)){
                return $key;
            }
        }
    }

    public static function getRegimenCode($regimen){
        foreach(CfdiData::$regimens as $key => $value){
            if(strtoupper($regimen) == strtoupper($value)){
                return $key;
            }
        }
    }

    public static function getContractCode($contract){
        foreach(CfdiData::$contracts as $key => $value){
            if(strtoupper($contract) == strtoupper($value)){
                return $key;
            }
        }
    }

    public static function getJournalCode($journal){
        foreach(CfdiData::$journals as $key => $value){
            if(strtoupper($journal) == strtoupper($value)){
                return $key;
            }
        }
    }

    public static function getHourCode($hour){
        foreach(CfdiData::$hours as $key => $value){
            if(strtoupper($hour) == strtoupper($value)){
                return $key;
            }
        }
    }
}