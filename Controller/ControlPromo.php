<?php
//UPLOAD
function loadclass($class){   
    require "../Model/".$class.'.class.php';
}
spl_autoload_register("loadclass");
if($_POST['create']=="OUI"){

$promotionManager=new PromotionManager();
$promotion = new Promotion(array("codepromo"=>"iM403M9D1sau31rP3RN8","utilise"=>"NON"));

return $promotionManager->createPromo($promotion);
}
if($_POST['unset']=="OUI"&& isset($_POST['codepromo'])){
    $promotionManager=new PromotionManager();
    $promotion = new Promotion(array("codepromo"=>$_POST['codepromo'],"utilise"=>"NON"));
    $promotionManager->unsetPromo($promotion);
}

?>