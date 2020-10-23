<?php
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';

}

spl_autoload_register("loadclass");

if($_POST['classification']=="allpaiement"){
    $comptableManager = new ComptableManager(MyPDO::getMysqlConnexion());
    if($_POST['modepaiement']=="mvola"){
    $dataqueryresult=$comptableManager->ListPaiementMobileMoney();
    }elseif($_POST['modepaiement']=='versement'){
    $dataqueryresult=$comptableManager->ListPaiementVersement();
    }elseif($_POST['modepaiement']=='virement'){
        $dataqueryresult=$comptableManager->ListPaiementVirement();
    }elseif($_POST['modepaiement']=='western'){
        $dataqueryresult=$comptableManager->ListPaiementWestern();
    }elseif($_POST['modepaiement']=='moneygram'){
        $dataqueryresult=$comptableManager->ListPaiementMoneyGram();
    }elseif($_POST['modepaiement']=='cheque'){
        $dataqueryresult=$comptableManager->ListPaiementCheque();
    }
    echo json_encode($dataqueryresult);
}else{

    $data = array();
    $date=new DateTime($_POST["datevalidation"]);
    $data["datevalidation"] = $date->format("Y-m-d") ;
    if (isset($_POST["nationalite"])) {
        $data["nationalite"] = $_POST["nationalite"];
    }
    if (isset($_POST["motif"])) {
        $data["motif"] = $_POST["motif"];
    }
    $comptableManager = new ComptableManager(MyPDO::getMysqlConnexion());
    if ($_POST['classification'] == "mvola") {
        $arraydata = $comptableManager->doClassificationMvola($data);
    } elseif ($_POST['classification'] == "western") {
        $arraydata = $comptableManager->doClassificationWestern($data);
    } elseif ($_POST['classification'] == "versement") {
        $arraydata = $comptableManager->doClassificationVersement($data);
    } elseif ($_POST['classification'] == "cheque") {
        $arraydata = $comptableManager->doClassificationCheque($data);
    } elseif ($_POST['classification'] == "virement") {
        $arraydata = $comptableManager->doClassificationVirement($data);
    } elseif ($_POST['classification'] == "MoneyGram") {
        $arraydata = $comptableManager->doClassificationMoneyGram($data);
    }
    echo json_encode($arraydata);

}

?>

