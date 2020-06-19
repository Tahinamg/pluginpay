<?php

function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerMobileMoney($db);

   if(isset($_POST['idmobilemoney'])){
       $idmobilemoney=$_POST['idmobilemoney'];
       $comptable->RefuserMoney($idmobilemoney);
       header("location:../Vue/dashboard.php?status='refuser'&mode='mobilemoney'");
   }
   
?>