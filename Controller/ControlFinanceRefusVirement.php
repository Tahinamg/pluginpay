<?php

function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerVirement($db);

   if(isset($_POST['idvirement'])){
       $idvirement=$_POST['idvirement'];
       $comptable->RefuserVirement($idvirement);
       header("location:../Vue/dashboard.php?status='refuser'&mode='virement'");
   }
   
?>