<?php


session_start();

if(!isset($_SESSION['matricule'])){
    header("location:Connecter");
}

$db=MyPDO::getMysqlConnexion();
$etudiantmanager=new EtudiantManager($db);
$matricule=(string)$_SESSION["matricule"];
$data=$etudiantmanager->createEtudiant($matricule);
$etudiant=new Etudiant($data);
$nationalite=(string)$etudiant->getNationalite();
$semestre=(string)$etudiant->getSemestre();
$id=(int)$etudiant->getIdetudiants();
$repechage=$etudiantmanager->getRepechageEtudiant($id);


$donne=array(
    'nom'=>$etudiant->getNom(),
    'prenom'=>$etudiant->getPrenom(),
    'numero'=>$etudiant->getNumero()
);
//TODO ASIVO CONTRAINTE OE A CHAQUE FIN DE 2 SEMESTRE DIA MIOVA 0 FOANA NY INSCRIPTION
$inscri=array();
$inscri=$etudiantmanager->dejaInscrit($donne);

$mpianatra = array("nationalite" =>$nationalite,
                   "semestre" =>$semestre,
                    "id"=>$id,
                    "repechage"=>$repechage[0]
                );
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