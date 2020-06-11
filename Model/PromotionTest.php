<?php
function loadclass($class){
   
    require $class.'.class.php';
   
}

spl_autoload_register("loadclass");

$promotionManager=new PromotionManager();
$promotion = new Promotion(array("codepromo"=>"7041MU3APDM3","utilise"=>"NON"));

$promotionManager->unsetPromo($promotion);
?>