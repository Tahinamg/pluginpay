<?php


session_start();
//TODO asio session matricule rehefa locale


if(!isset($_SESSION['matricule'])){
    header("location: ../index.html");
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
$inscri=$etudiantmanager->dejaInscrit($donne);


$mpianatra = array("nationalite" =>$nationalite,
                   "semestre" =>$semestre,
                    "id"=>$id,
                    "repechage"=>$repechage[0]
                );


?>