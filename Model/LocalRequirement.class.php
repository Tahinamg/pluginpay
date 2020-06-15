<?php
class LocalRequirement{
    static protected $link='
    <link rel="stylesheet" href="CSS/bootstrap.min.css"/>
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/main.css" />';
    static protected $script='<script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
    <script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js" ></script>
    <script type="text/javascript" src="JS/all.min.js"></script>
    <script type="text/javascript" src="JS/bootstrap.min.js"></script>
    <script type="text/javascript" src="JS/paiement.js"></script>';

    public static function getLink(){
        return SELF::$link;
    }
    public static function getScript(){
        return SELF::$script;
    }
}

?>