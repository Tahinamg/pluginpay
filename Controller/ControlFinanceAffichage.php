<?php
ob_start();
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   //UPLOAD
}

spl_autoload_register("loadclass");

if(isset($_GET['recouvrement'])){
    //LIST LES VAGUES POUR LES SELECTS RECOUVREMENTS
    $compta=new ComptableManager(MyPDO::getMysqlConnexion());
    $datalistvague=$compta->listDateEntreeParVague();
    echo json_encode($datalistvague);
}
if(isset($_GET['notification']) && $_GET['notification']=="mvola"){
    $ComptableManagerMobileMoney= new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
    $dataMvola=$ComptableManagerMobileMoney->VoirMobileMoney();
    echo json_encode($dataMvola);
}

if(isset($_GET['notification']) && $_GET['notification']=='cheque'){
    $ComptableManagerCheque= new ComptableManagerCheque(MyPDO::getMysqlConnexion());
    $dataCheque=$ComptableManagerCheque->VoirCheque();
    echo json_encode($dataCheque);
}

if(isset($_GET['notification']) && $_GET['notification']=='virement'){
    $ComptableManagerVirement= new ComptableManagerVirement(MyPDO::getMysqlConnexion());
    $dataVirement=$ComptableManagerVirement->VoirVirement();
    echo json_encode($dataVirement);
}

if(isset($_GET['notification']) && $_GET['notification']=='versement'){
    $ComptableManagerVersement= new ComptableManagerVersement(MyPDO::getMysqlConnexion());
    $dataVersement=$ComptableManagerVersement->VoirVersement();
    echo json_encode($dataVersement);
}
if(isset($_GET['notification']) && $_GET['notification']=="western"){
    $ComptableManagerWestern= new ComptableManagerWestern(MyPDO::getMysqlConnexion());
    $dataWestern=$ComptableManagerWestern->VoirWestern();
    echo json_encode($dataWestern);
}if(isset($_GET['notification'])&& $_GET['notification']=="MoneyGram"){
    $comptableManagerMoneyGram=new ComptableManagerMoneyGram(MyPDO::getMysqlConnexion());
    $dataMoneyGram=$comptableManagerMoneyGram->voirMoneyGram();
    echo json_encode($dataMoneyGram);
}

?>