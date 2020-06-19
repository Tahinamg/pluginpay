<?php
ob_start();

function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");


if(isset($_GET['paiement']) && $_GET['paiement']=="MobileMoney"){
    $ComptableManagerMoney=new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
    $count=$ComptableManagerMoney->NotifMobileMoney();
    echo $count[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Western"){
    $ComptableManagerWestern=new ComptableManagerWestern(MyPDO::getMysqlConnexion());
    $count=$ComptableManagerWestern->NotifWestern();
    echo $count[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Cheque"){
    $ComptableManagerCheque=new ComptableManagerCheque(MyPDO::getMysqlConnexion());
    $count=$ComptableManagerCheque->NotifCheque();
    echo $count[0];
}


if(isset($_GET['paiement']) && $_GET['paiement']=="Virement"){
    $ComptableManagerVirement=new ComptableManagerVirement(MyPDO::getMysqlConnexion());
    $count=$ComptableManagerVirement->NotifVirement();
    echo $count[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Versement"){
    $ComptableManagerVersement=new ComptableManagerVersement(MyPDO::getMysqlConnexion());
    $count=$ComptableManagerVersement->NotifVersement();
    echo $count[0];
}

?>