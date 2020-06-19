<?php
class Cdn{
    
    static protected $bootstrapcss='<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>';
    static protected $bootstrapjs='<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>';
    static protected $jquery='<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>';
   static protected $popper='<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>';


   public static function getBootsrapcss(){
    return SELF::$bootstrapcss;
   }
   public static function getBootstrapjs(){
       return SELF::$bootstrapjs;
   }
   Public static function getJquery(){
       return SELF::$jquery;
   }
   public static function getPopper(){
       return SELF::$popper;
   }
}
?>