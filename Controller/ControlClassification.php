<?php
header('Content-type: application/json; charset=utf-8"');
function loadclass($class){
   
    require "../Model/".$class.'.class.php';

}

spl_autoload_register("loadclass");
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
?>

