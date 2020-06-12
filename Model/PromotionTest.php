<?php
function loadclass($class){
   
    require $class.'.class.php';
   
}

spl_autoload_register("loadclass");

$promotionManager=new PromotionManager();
$promotion = new Promotion(array("codepromo"=>"RrD1P92M4s0N2uia133M","utilise"=>"NON"));
?>