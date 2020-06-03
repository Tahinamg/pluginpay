<?php
function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");
include('../Controller/Transaction.php');
?>