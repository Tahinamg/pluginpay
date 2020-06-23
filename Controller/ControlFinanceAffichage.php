<?php
//UPLOAD
ob_start();
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");

if(isset($_GET['notification']) && $_GET['notification']=="mvola"){
    $ComptableManagerMobileMoney= new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
    $data1=$ComptableManagerMobileMoney->VoirMobileMoney();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='cheque'){
    $ComptableManagerCheque= new ComptableManagerCheque(MyPDO::getMysqlConnexion());
    $data1=$ComptableManagerCheque->VoirCheque();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='virement'){
    $ComptableManagerVirement= new ComptableManagerVirement(MyPDO::getMysqlConnexion());
    $data1=$ComptableManagerVirement->VoirVirement();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='versement'){
    $ComptableManagerVersement= new ComptableManagerVersement(MyPDO::getMysqlConnexion());
    $data1=$ComptableManagerVersement->VoirVersement();
    echo json_encode($data1);
}
if(isset($_GET['notification']) && $_GET['notification']=="western"){
    $ComptableManagerWestern= new ComptableManagerWestern(MyPDO::getMysqlConnexion());
    $data1=$ComptableManagerWestern->VoirWestern();
    echo json_encode($data1);
}
?>