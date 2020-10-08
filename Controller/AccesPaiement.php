<?php


session_start();

if(!isset($_SESSION['matricule'])){
    header("location:Connecter");
}

$db=MyPDO::getMysqlConnexion();
$etudiantmanager=new EtudiantManager($db);
$ProduitManager=new ProduitManager($db);
$matricule=(string)$_SESSION["matricule"];
$data=$etudiantmanager->createEtudiant($matricule);
$etudiant=new Etudiant($data);
$id=(int)$etudiant->getIdetudiants();
$repechage=$etudiantmanager->getRepechageEtudiant($id);

$mpianatra = array("nationalite" =>(string)$etudiant->getNationalite(),
                   "semestre" =>(string)$etudiant->getSemestre(),
                    "id"=>$id,
                    "repechage"=>$repechage[0]
                );

$donne=array(
    'nom'=>$etudiant->getNom(),
    'prenom'=>$etudiant->getPrenom(),
    'numero'=>$etudiant->getNumero()
);
//TODO ASIVO CONTRAINTE OE A CHAQUE FIN DE 2 SEMESTRE DIA MIOVA 0 FOANA NY INSCRIPTION
$inscri=array();
$inscri=$etudiantmanager->dejaInscrit($donne);

if($mpianatra["id"]==0){
    header("location:Connecter");
}

if($mpianatra['nationalite']=="MG"){
    setcookie("Origin","LOCAL",0,'/');
    setcookie("Semestre",$mpianatra['semestre'],0,'/');
    setcookie("Inscription",$inscri[0],0,'/');
}else{
    setcookie("Origin","ETRANGER",0,'/');
    setcookie("Semestre",$mpianatra['semestre'],0,'/');
    setcookie("Inscription",$inscri[0],0,'/');
}
?>