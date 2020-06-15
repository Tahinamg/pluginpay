<?php

function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");


$prix_promotion=array();

$prix_promotion['ETRANGER']['S1']['0']=80;//etranger S1 Non inscri
$prix_promotion['ETRANGER']['S1']['1']=40;//etranger S1 DEJA inscri mais double filière
$prix_promotion['ETRANGER']['S2']['0']=80;
$prix_promotion['ETRANGER']['S2']['1']=40;
$prix_promotion['ETRANGER']['S3']['0']=80;
$prix_promotion['ETRANGER']['S3']['1']=40;
$prix_promotion['ETRANGER']['S4']['0']=80;
$prix_promotion['ETRANGER']['S4']['1']=40;
$prix_promotion['ETRANGER']['S5']['0']=80;
$prix_promotion['ETRANGER']['S5']['1']=40;
$prix_promotion['ETRANGER']['S6']['0']=80;
$prix_promotion['ETRANGER']['S6']['1']=40;
$prix_promotion['ETRANGER']['S7']['0']=100;//Etranger Master Non inscri
$prix_promotion['ETRANGER']['S7']['1']=50;//Etranger Master Inscri mais double filiere
$prix_promotion['ETRANGER']['S8']['0']=100;
$prix_promotion['ETRANGER']['S8']['1']=50;
$prix_promotion['ETRANGER']['S9']['0']=100;
$prix_promotion['ETRANGER']['S9']['1']=50;
$prix_promotion['ETRANGER']['S10']['0']=100;
$prix_promotion['ETRANGER']['S10']['1']=50;

$prix_promotion['LOCAL']['S1']['0']=150000;//LOCAL S1 Non inscri
$prix_promotion['LOCAL']['S1']['1']=75000;//LOCAL S1 DEJA inscri mais double filière
$prix_promotion['LOCAL']['S2']['0']=150000;
$prix_promotion['LOCAL']['S2']['1']=75000;
$prix_promotion['LOCAL']['S3']['0']=150000;
$prix_promotion['LOCAL']['S3']['1']=75000;
$prix_promotion['LOCAL']['S4']['0']=150000;
$prix_promotion['LOCAL']['S4']['1']=75000;
$prix_promotion['LOCAL']['S5']['0']=150000;
$prix_promotion['LOCAL']['S5']['1']=75000;
$prix_promotion['LOCAL']['S6']['0']=150000;
$prix_promotion['LOCAL']['S6']['1']=75000;
$prix_promotion['LOCAL']['S7']['0']=160000;//LOCAL Master Non inscri
$prix_promotion['LOCAL']['S7']['1']=80000;//LOCAL Master Inscri mais double filiere
$prix_promotion['LOCAL']['S8']['0']=160000;
$prix_promotion['LOCAL']['S8']['1']=80000;
$prix_promotion['LOCAL']['S9']['0']=160000;
$prix_promotion['LOCAL']['S9']['1']=80000;
$prix_promotion['LOCAL']['S10']['0']=160000;
$prix_promotion['LOCAL']['S10']['1']=80000;



if(isset($_POST['codepromo'])){

    $data_codepromo=array("codepromo"=>$_POST['codepromo'],"utilise"=>"NON");
    $code_promo=new Promotion($data_codepromo);
    $code_promo_manager=new PromotionManager();
    if($code_promo_manager->existPromo($code_promo)){
        //check if the value of the cookie is realy exact
        if(isset($_POST['Origin'],$_POST['Semestre'],$_POST['Inscription'])){
            $keys_prix_promotion=array($_POST['Origin'],$_POST['Semestre'],$_POST['Inscription']);
            if(array_key_exists($keys_prix_promotion[0],$prix_promotion)&&array_key_exists($keys_prix_promotion[1],$prix_promotion[$keys_prix_promotion[0]])&&array_key_exists($keys_prix_promotion[2],$prix_promotion[$keys_prix_promotion[0]][$keys_prix_promotion[1]])){
                $code_promo_manager->utiliseCodePromo($code_promo);
                echo $prix_promotion[$keys_prix_promotion[0]][$keys_prix_promotion[1]][$keys_prix_promotion[2]];
                   
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }
        
    }else{
        echo 0;
    }
}else{
    header("location:../index.html");
}


  

?>