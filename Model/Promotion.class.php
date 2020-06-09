<?php
final class Promotion{
    static public $CODEPROMO;
    static public $UTILISE;
    public static function generateCodePromo(){
    array_push(SELF::$CODEPROMO,/*str_shuffle("853Md1aP70m0!$")*/"1234567");
       array_push(SELF::$UTILISE,"NON");
    }
    public static function useCodePromo($codepromo){
    if(array_search($codepromo,SELF::$CODEPROMO,false)!==false){
        foreach(array_keys(SELF::$CODEPROMO,$codepromo,TRUE) as $key){
            SELF::$UTILISE[$key]="OUI";
        }
        return true;
    }else{
        return false;
    }
   
    }
    public static function getCodePromoNotUsing(){
        $promodisponible=array();
        foreach(array_keys(SELF::$UTILISE,"NON",TRUE) as $key){
            array_push($promodisponible,SELF::$CODEPROMO[$key]);
        };
        return $promodisponible;
    }

    public static function getCodePromoUsing(){
        $promodisponible=array();
        foreach(array_keys(SELF::$UTILISE,"OUI",TRUE) as $key){
            array_push($promodisponible,SELF::$CODEPROMO[$key]);
        };
        return $promodisponible;
    }
    public static function destroyCodePromoUsing(){
        foreach(array_keys(SELF::$UTILISE,"OUI",TRUE) as $key){
            unset(SELF::$CODEPROMO[$key]);
            unset(SELF::$UTILISE[$key]);
        }
    }
}
?>