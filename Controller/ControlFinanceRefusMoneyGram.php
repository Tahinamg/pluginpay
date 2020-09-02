<?php

function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerMoneyGram($db);

   if(isset($_POST['idmoneygram'])){
       $idmoneygram=$_POST['idmoneygram'];
       $comptable->RefuserMoneyGram($idmoneygram);
       header("location:../Vue/dashboard.php?status='refuser'&mode='moneygram'");
   }
   
?>