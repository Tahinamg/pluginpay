<?php

function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerVirement($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);

if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idvirement']);
            $comptable->ValiderInscriptionViaVirement($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement inscription par virement","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='virement'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idvirement']);
            $comptable->ValiderEcolageViaVirement($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement ecolage par virement","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='virement'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idvirement']);
            $comptable->ValiderDroitExamenViaVirement($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement droit examen semestriel par virement","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='virement'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idvirement']);
            $comptable->ValiderSoutenanceViaVirement($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement droit de soutenance par virement","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='virement'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idvirement']);
            $comptable->ValiderRepechageViaVirement($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement repechage par virement","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='virement'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idvirement']);
            $comptable->ValiderCertificat($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement certificat par virement","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='virement'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@gmail.com ou +261348472828';
            break;
    }
}


?>