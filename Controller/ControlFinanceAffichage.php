<?php
//TODO A UPLOADER
ob_start();
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");



$ComptableManagerMobileMoney= new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
$ComptableManagerVersement= new ComptableManagerVersement(MyPDO::getMysqlConnexion());
$ComptableManagerVirement= new ComptableManagerVirement(MyPDO::getMysqlConnexion());
$ComptableManagerCheque= new ComptableManagerCheque(MyPDO::getMysqlConnexion());
$ComptableManagerWestern= new ComptableManagerWestern(MyPDO::getMysqlConnexion());

if(isset($_GET['notification']) && $_GET['notification']=="mvola"){
    $data1=$ComptableManagerMobileMoney->VoirMobileMoney();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='cheque'){
    $data1=$ComptableManagerCheque->VoirCheque();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='virement'){
    $data1=$ComptableManagerVirement->VoirVirement();
    echo json_encode($data1);
}

if(isset($_GET['notification']) && $_GET['notification']=='versement'){
    $data1=$ComptableManagerVersement->VoirVersement();
    echo json_encode($data1);
}
if(isset($_GET['notification']) && $_GET['notification']=="western"){
    $data1=$ComptableManagerWestern->VoirWestern();
    echo json_encode($data1);
}
?>