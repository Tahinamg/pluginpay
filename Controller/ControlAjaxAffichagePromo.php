<?php
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");

$promotionManager=new PromotionManager();
$promotion = new Promotion(array("codepromo"=>"iM403M9D1sau31rP3RN8","utilise"=>"NON"));
if(isset($_POST['utilisation'])){
    if($_POST['utilisation']=="OUI"){
        echo $promotionManager->listUsedPromo();
    }else if($_POST['utilisation']=="NON"){
            echo  $promotionManager->listUnusedPromo();
    }
    
}

?>