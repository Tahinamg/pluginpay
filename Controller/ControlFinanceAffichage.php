<?php
ob_start();
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
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
if(isset($_POST['classification'],$_POST['date'],$_POST['motif'],$_POST['vague'])){
if($_POST['classification']=="mvola"){
    
    $date=new DateTime($_POST['date']);
    $comptableManagerMoney=new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
    $data=$comptableManagerMoney->ListPaiementMobileMoney($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}elseif($_POST['classification']=="western"){
    $date=new DateTime($_POST['date']);
    $ComptableManagerWestern=new ComptableManagerWestern(MyPDO::getMysqlConnexion());
    $data=$ComptableManagerWestern->ListPaiementWestern($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}elseif($_POST['classification']=="cash"){
    $date=new DateTime($_POST['date']);
    $ComptableManagerVersement=new ComptableManagerVersement(MyPDO::getMysqlConnexion());
    $data=$ComptableManagerVersement->ListPaiementVersement($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}elseif($_POST['classification']=="cheque"){
    $date=new DateTime($_POST['date']);
    $ComptableManagerCheque=new ComptableManagerCheque(MyPDO::getMysqlConnexion());
    $data=$ComptableManagerCheque->ListPaiementCheque($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}elseif($_POST['classification']=="virement"){
    $date=new DateTime($_POST['date']);
    $ComptableManagerVirement=new ComptableManagerVirement(MyPDO::getMysqlConnexion());
    $data=$ComptableManagerVirement->ListPaiementVirement($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}elseif($_POST['classification']=="MoneyGram"){
    $date=new DateTime($_POST['date']);
    $comptableManagerMoneyGram=new ComptableManagerMoneyGram(MyPDO::getMysqlConnexion());
    $data=$comptableManagerMoneyGram->ListPaiementMoneyGram($date->format('Y-m'),$_POST['motif'],$_POST['vague']);
    echo json_encode($data);
}
}
?>