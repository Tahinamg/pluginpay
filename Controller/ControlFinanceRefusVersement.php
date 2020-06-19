<?php

function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerVersement($db);

   if(isset($_POST['idversement'])){
       $idversement=$_POST['idversement'];
       $comptable->RefuserVersement($idversement);
       header("location:../Vue/dashboard.php?status='refuser'&mode='versement'");
   }
   
?>