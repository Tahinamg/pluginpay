<?php
function loadclass($class){   
    require "../Model/".$class.'.class.php';
}
spl_autoload_register("loadclass");
if(isset($_POST['create'])){
    if($_POST['create']=="OUI"){

        $promotionManager=new PromotionManager();
        $promotion = new Promotion(array("codepromo"=>"iM403M9D1sau31rP3RN8","utilise"=>"NON"));
        //return true
        echo $promotionManager->createPromo($promotion);
        }
}

if(isset($_POST['unset'])){

    if($_POST['unset']=="OUI"&& isset($_POST['codepromo'])){
        $promotionManager=new PromotionManager();
        $promotion = new Promotion(array("codepromo"=>$_POST['codepromo'],"utilise"=>"NON"));
        $promotionManager->unsetPromo($promotion);
        echo 'unset success';
    }
}

?>