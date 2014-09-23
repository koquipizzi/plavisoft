<?php

/**
 * Esta extension permite convertir numeros Flotantes a texto. 
 * La forma de llamarlo
 * 
 *  $a = Yii::app()->nombre2text;
 *  echo $a->toText(9948598983.75);
 * 
 */

class NumberToText{
    
    private $dic = array(
        "conector" => " y ",
        "1"  =>  "uno",
        "2"  =>  "dos",
        "3"  =>  "tres",
        "4"  =>  "cuatro",
        "5"  =>  "cinco",
        "6"  =>  "seis",
        "7"  =>  "siete",
        "8"  =>  "ocho",
        "9"  =>  "nueve",
        "10" =>  "diez",
        "11" =>  "once",
        "12" =>  "doce",
        "13" =>  "trece",
        "14" =>  "catorce",
        "15" =>  "quince",
        "16" =>  "dieciséis",
        "17" =>  "diecisiete",
        "18" =>  "dieciocho",
        "19" =>  "diecinueve",
        "20" =>  "veinte",
        
        "2?" =>  "veinti",
        "30" =>  "treinta", 
        "40" =>  "cuarenta", 
        "50" =>  "cincuenta", 
        "60" =>  "sesenta", 
        "70" =>  "setenta", 
        "80" =>  "ochenta", 
        "90" =>  "noventa", 
        "100" =>  "cien", 
        "10?" =>  "ciento ",         
        "?00" =>  "cientos ",
        "500" =>  "quinientos ",
        "700" =>  "setecientos ",
        "900" =>  "novecientos ",
        "1000" =>  "mil ",
        "1000000" =>  "Un millon ",
        "100000?" =>  " millones ",
        
    );
    
    public function init(){
        
    }
    
    
    public function toText($number){
        if(is_float($number)){
            return $this->decimals($number);
        }
        elseif(array_key_exists($number, $this->dic)){
            return $this->dic[$number];
        }
        elseif ($number<100) {
            return $this->less100($number);
        }
        elseif ($number<1000) {
            return $this->less1000($number);
        }
        elseif ($number<1000000) {
            return $this->less1Millon($number);
        }
        else{
            return $this->moreThan1Millon($number);
        }
        
    }
    
    
    public function decimals($number, $decimalsToText = FALSE, $decimals = 2){
        $ent = floor($number);
        $res = $number - $ent;
        $res = floor($res * pow(10,$decimals));
        
        $r = '';

        if($res != 0){
            if($decimalsToText){
                $r = $this->toText((int)$ent) . " con " . $this->toText((int)$res);
            }
            else{
                $r = $this->toText((int)$ent) . " / " . $res;
            }
        }
        else{
            $r = $this->toText((int)$ent);
        }

        return $r;
    }
    
    
    public function less100($number){
        $ent = floor($number);
        $res = $ent % 10;
        $ent = $ent - $res;
        
        if($ent == 20){
            $r = $this->dic['2?'] . $this->dic[$res];
        }
        else{
            $r = $this->toText((int)$ent) . $this->dic['conector'] . $this->dic[$res];
        }

        return $r;
    }
        
    
    public function less1000($number){
        $ent = floor($number);
        $res = $ent % 100;
        $dig = ($ent - $res) / 100;
        
        if($dig == 1){
            $r = $this->dic['10?'] . $this->toText((int)$res);
        }
        elseif($dig == 5){
            $r = $this->dic['500'] . $this->toText((int)$res);
        }
        elseif($dig == 7){
            $r = $this->dic['700'] . $this->toText((int)$res);
        }
        else{
            $r = $this->dic[$dig] . $this->dic['?00'] . $this->toText((int)$res);
        }

        return $r;
    } 
 
    
    public function less1Millon($number){
        $ent = floor($number);
        $res = $ent % 1000;
        $ent = ($ent - $res) / 1000;
        
        if ($ent == 1)
            $r = $this->dic['1000'] . $this->toText((int)$res);
        else {
            $r = $this->toText((int)$ent) . " " . $this->dic['1000'] . $this->toText((int)$res);
        }

        return $r;
    } 
     
    
    public function moreThan1Millon($number){
        $ent = floor($number);
        $res = $ent % 1000000;
        $ent = ($ent - $res) / 1000000;

        if ($ent == 1)
            $r = $this->dic['1000000'] . $this->toText((int)$res);
        else {
            $r = $this->toText((int)$ent) . " " . $this->dic['100000?'] . $this->toText((int)$res);
        }


        return $r;
    } 
     
    
}