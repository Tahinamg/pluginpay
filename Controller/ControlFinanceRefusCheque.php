<?php

function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerCheque($db);

   if(isset($_POST['idcheque'])){
       $idcheque=$_POST['idcheque'];
       $comptable->RefuserCheque($idcheque);
       header("location:../Vue/dashboard.php?status='refuser'&mode='cheque'");
   }
   
?>