<?php
ob_start();
function loadclass($class){
   
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");


if(isset($_GET['paiement']) && $_GET['paiement']=="MobileMoney"){
    $ComptableManagerMoney=new ComptableManagerMobileMoney(MyPDO::getMysqlConnexion());
    $countMobileMoney=$ComptableManagerMoney->NotifMobileMoney();
    echo $countMobileMoney[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Western"){
    $ComptableManagerWestern=new ComptableManagerWestern(MyPDO::getMysqlConnexion());
    $countWestern=$ComptableManagerWestern->NotifWestern();
    echo $countWestern[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Cheque"){
    $ComptableManagerCheque=new ComptableManagerCheque(MyPDO::getMysqlConnexion());
    $countCheque=$ComptableManagerCheque->NotifCheque();
    echo $countCheque[0];
}


if(isset($_GET['paiement']) && $_GET['paiement']=="Virement"){
    $ComptableManagerVirement=new ComptableManagerVirement(MyPDO::getMysqlConnexion());
    $countVirement=$ComptableManagerVirement->NotifVirement();
    echo $countVirement[0];
}

if(isset($_GET['paiement']) && $_GET['paiement']=="Versement"){
    $ComptableManagerVersement=new ComptableManagerVersement(MyPDO::getMysqlConnexion());
    $countVersement=$ComptableManagerVersement->NotifVersement();
    echo $countVersement[0];
}
if(isset($_GET['paiement']) &&$_GET['paiement']=="MoneyGram"){
    $comptableManagerMoneyGram=new ComptableManagerMoneyGram(MyPDO::getMysqlConnexion());
    $countMoneyGram=$comptableManagerMoneyGram->notifMoneyGram();
    echo $countMoneyGram[0];
}

?>