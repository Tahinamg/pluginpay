<?php
function loadclass($class){
       
       require_once "../Model/".$class.'.class.php';
      
   }
   spl_autoload_register("loadclass");
   
   $db=MyPDO::getMysqlConnexion();
   $comptable=new ComptableManagerWestern($db);

   if(isset($_POST['idwestern'])){
       $idwestern=$_POST['idwestern'];
       $comptable->RefuserWestern($idwestern);
       header("location:../Vue/dashboard.php?status='refuser'&mode='western'");
   }
   
?>