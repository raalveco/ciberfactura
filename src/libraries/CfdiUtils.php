<?php
namespace Raalveco\Ciberfactura\Libraries;

class CfdiUtils {
    public static function numeroLetra($n){

        $unidades = $n % 1000;
        $millares = intval($n / 1000) % 1000;
        $millones = intval(intval($n / 1000)/1000);

        if($n<0) return "";

        if($n==0) return "CERO";

        if($n<1000) return Numeros::convertir($unidades);

        if($n<1000000){
            if($millares == 1) return "MIL ".Formato::convertir($unidades);

            return Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
        }

        if($millones == 1){
            if($millares==0 && $unidades==0) return "UN MILLON DE";
            if($millares==0) return "UN MILLON ".Numeros::convertir($unidades);
            if($millares==1) return "UN MILLON MIL ".Numeros::convertir($unidades);
            return "UN MILLON ".Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
        }

        if($millares==0 && $unidades==0){
            return Numeros::convertir($millones)." MILLONES DE";
        }

        return Numeros::convertir($millones)." MILLONES ".Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
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
                case 2: return "VEINTI".Numeros::convertir($u);
                case 3: return $u==0 ? "TREINTA" : "TREINTA Y ".Numeros::convertir($u);
                case 4: return $u==0 ? "CUARENTA" : "CUARENTA Y ".Numeros::convertir($u);
                case 5: return $u==0 ? "CINCUENTA" : "CINCUENTA Y ".Numeros::convertir($u);
                case 6: return $u==0 ? "SESENTA" : "SESENTA Y ".Numeros::convertir($u);
                case 7: return $u==0 ? "SETENTA" : "SETENTA Y ".Numeros::convertir($u);
                case 8: return $u==0 ? "OCHENTA" : "OCHENTA Y ".Numeros::convertir($u);
                case 9: return $u==0 ? "NOVENTA" : "NOVENTA Y ".Numeros::convertir($u);
            }
        }

        if($n==100) return "CIEN";


        if($n<1000){
            switch($c){
                case 1: return "CIENTO ".Numeros::convertir($d.$u);
                case 2: return "DOSCIENTOS ".Numeros::convertir($d.$u);
                case 3: return "TRESCIENTOS ".Numeros::convertir($d.$u);
                case 4: return "CUATROCIENTOS ".Numeros::convertir($d.$u);
                case 5: return "QUINIENTOS ".Numeros::convertir($d.$u);
                case 6: return "SEISCIENTOS ".Numeros::convertir($d.$u);
                case 7: return "SETECIENTOS ".Numeros::convertir($d.$u);
                case 8: return "OCHOCIENTOS ".Numeros::convertir($d.$u);
                case 9: return "NOVECIENTOS ".Numeros::convertir($d.$u);
            }
        }

        if($n==1000) return "MIL";
    }
}

class Formato{
    public static function mayusculas($word){
        $word = strtoupper($word);

        $word = str_replace("á","Á", $word);
        $word = str_replace("é","É", $word);
        $word = str_replace("í","Í", $word);
        $word = str_replace("ó","Ó", $word);
        $word = str_replace("ú","Ú", $word);
        $word = str_replace("ñ","Ñ", $word);

        return $word;
    }

    public static function numeroLetra($n){

        $unidades = $n % 1000;
        $millares = intval($n / 1000) % 1000;
        $millones = intval(intval($n / 1000)/1000);

        if($n<0) return "";

        if($n==0) return "CERO";

        if($n<1000) return Numeros::convertir($unidades);

        if($n<1000000){
            if($millares == 1) return "MIL ".Formato::convertir($unidades);

            return Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
        }

        if($millones == 1){
            if($millares==0 && $unidades==0) return "UN MILLON DE";
            if($millares==0) return "UN MILLON ".Numeros::convertir($unidades);
            if($millares==1) return "UN MILLON MIL ".Numeros::convertir($unidades);
            return "UN MILLON ".Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
        }

        if($millares==0 && $unidades==0){
            return Numeros::convertir($millones)." MILLONES DE";
        }

        return Numeros::convertir($millones)." MILLONES ".Numeros::convertir($millares)." MIL ".Numeros::convertir($unidades);
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
                case 2: return "VEINTI".Numeros::convertir($u);
                case 3: return $u==0 ? "TREINTA" : "TREINTA Y ".Numeros::convertir($u);
                case 4: return $u==0 ? "CUARENTA" : "CUARENTA Y ".Numeros::convertir($u);
                case 5: return $u==0 ? "CINCUENTA" : "CINCUENTA Y ".Numeros::convertir($u);
                case 6: return $u==0 ? "SESENTA" : "SESENTA Y ".Numeros::convertir($u);
                case 7: return $u==0 ? "SETENTA" : "SETENTA Y ".Numeros::convertir($u);
                case 8: return $u==0 ? "OCHENTA" : "OCHENTA Y ".Numeros::convertir($u);
                case 9: return $u==0 ? "NOVENTA" : "NOVENTA Y ".Numeros::convertir($u);
            }
        }

        if($n==100) return "CIEN";


        if($n<1000){
            switch($c){
                case 1: return "CIENTO ".Numeros::convertir($d.$u);
                case 2: return "DOSCIENTOS ".Numeros::convertir($d.$u);
                case 3: return "TRESCIENTOS ".Numeros::convertir($d.$u);
                case 4: return "CUATROCIENTOS ".Numeros::convertir($d.$u);
                case 5: return "QUINIENTOS ".Numeros::convertir($d.$u);
                case 6: return "SEISCIENTOS ".Numeros::convertir($d.$u);
                case 7: return "SETECIENTOS ".Numeros::convertir($d.$u);
                case 8: return "OCHOCIENTOS ".Numeros::convertir($d.$u);
                case 9: return "NOVECIENTOS ".Numeros::convertir($d.$u);
            }
        }

        if($n==1000) return "MIL";
    }
}

?>
