<?php
ob_start();

function loadclass($class){
       
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");

if(isset($_POST['matricule'],$_POST['password'])){
    $data=array(
        "matricule"=>htmlspecialchars($_POST['matricule']),
        "mdp"=>md5($_POST['password'])
    );
    
    $compta=new ComptableManager(MyPDO::getMysqlConnexion());
    $acces=$compta->getAccess($data)[0];
    if($acces==1){
        session_start();
        $_SESSION['finance']='gael';
        header("location:../Vue/dashboard.php");
    }else{
        
        header("location:../Vue/logindashboard.php?erreur=1");
    }
}else{
    header("location:../Vue/logindashboard.php?erreur=12");
}

ob_flush();
?>