<?php
namespace Raalveco\Ciberfactura\Libraries;

class CfdiUtilities {
    public static function numeroLetra($n){

        $unidades = $n % 1000;
        $millares = intval($n / 1000) % 1000;
        $millones = intval(intval($n / 1000)/1000);

        if($n<0) return "";

        if($n==0) return "CERO";

        if($n<1000) return CfdiUtilities::convertir($unidades);

        if($n<1000000){
            if($millares == 1) return "MIL ".CfdiUtilities::convertir($unidades);

            return CfdiUtilities::convertir($millares)." MIL ".CfdiUtilities::convertir($unidades);
        }

        if($millones == 1){
            if($millares==0 && $unidades==0) return "UN MILLON DE";
            if($millares==0) return "UN MILLON ".CfdiUtilities::convertir($unidades);
            if($millares==1) return "UN MILLON MIL ".CfdiUtilities::convertir($unidades);
            return "UN MILLON ".CfdiUtilities::convertir($millares)." MIL ".CfdiUtilities::convertir($unidades);
        }

        if($millares==0 && $unidades==0){
            return CfdiUtilities::convertir($millones)." MILLONES DE";
        }

        return CfdiUtilities::convertir($millones)." MILLONES ".CfdiUtilities::convertir($millares)." MIL ".CfdiUtilities::convertir($unidades);
    }

    public static function convertir($n){
        $u = $n % 10;
        $d = intval($n / 10) % 10;
        $c = intval(intval($n / 10) / 10);

        if($n<=20){
            switch($n){
                case 0: return "";
                case 1: return "UN";
                case 2: return "DOS";
                case 3: return "TRES";
                case 4: return "CUATRO";
                case 5: return "CINCO";
                case 6: return "SEIS";
                case 7: return "SIETE";
                case 8: return "OCHO";
                case 9: return "NUEVE";
                case 10: return "DIEZ";
                case 11: return "ONCE";
                case 12: return "DOCE";
                case 13: return "TRECE";
                case 14: return "CATORCE";
                case 15: return "QUINCE";
                case 16: return "DIECISEIS";
                case 17: return "DIECISIETE";
                case 18: return "DIECIOCHO";
                case 19: return "DIECINUEVE";
                case 20: return "VEINTE";
            }
        }

        if($n<100){
            switch($d){
                case 2: return "VEINTI".CfdiUtilities::convertir($u);
                case 3: return $u==0 ? "TREINTA" : "TREINTA Y ".CfdiUtilities::convertir($u);
                case 4: return $u==0 ? "CUARENTA" : "CUARENTA Y ".CfdiUtilities::convertir($u);
                case 5: return $u==0 ? "CINCUENTA" : "CINCUENTA Y ".CfdiUtilities::convertir($u);
                case 6: return $u==0 ? "SESENTA" : "SESENTA Y ".CfdiUtilities::convertir($u);
                case 7: return $u==0 ? "SETENTA" : "SETENTA Y ".CfdiUtilities::convertir($u);
                case 8: return $u==0 ? "OCHENTA" : "OCHENTA Y ".CfdiUtilities::convertir($u);
                case 9: return $u==0 ? "NOVENTA" : "NOVENTA Y ".CfdiUtilities::convertir($u);
            }
        }

        if($n==100) return "CIEN";


        if($n<1000){
            switch($c){
                case 1: return "CIENTO ".CfdiUtilities::convertir($d.$u);
                case 2: return "DOSCIENTOS ".CfdiUtilities::convertir($d.$u);
                case 3: return "TRESCIENTOS ".CfdiUtilities::convertir($d.$u);
                case 4: return "CUATROCIENTOS ".CfdiUtilities::convertir($d.$u);
                case 5: return "QUINIENTOS ".CfdiUtilities::convertir($d.$u);
                case 6: return "SEISCIENTOS ".CfdiUtilities::convertir($d.$u);
                case 7: return "SETECIENTOS ".CfdiUtilities::convertir($d.$u);
                case 8: return "OCHOCIENTOS ".CfdiUtilities::convertir($d.$u);
                case 9: return "NOVECIENTOS ".CfdiUtilities::convertir($d.$u);
            }
        }

        if($n==1000) return "MIL";
    }
}

?>
