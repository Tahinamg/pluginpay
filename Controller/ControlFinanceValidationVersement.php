<?php
//UPLOAD
function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerVersement($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);
if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderInscriptionViaVersement($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement inscription par versement","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='versement'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderEcolageViaVersement($data[0],$data[1],$data[2],$data[3]);
            mail($etudiant->getMail(),"E-media paiement ecolage par versement","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='versement'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaVersement($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement droit examen semestriel par versement","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='versement'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaVersement($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement droit de soutenance par versement","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='versement'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderRepechageViaVersement($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement repechage par versement","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='versement'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement certificat par versement","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='versement'");
            break;
        default:
            echo 'contacter le webmester  Ravelojaonanatanaela8@gmail.com ou +261348472828';
            break;
    }
}


?>