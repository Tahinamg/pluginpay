<?php
//UPLOAD
function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerWestern($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);

if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderInscriptionViaWestern($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement inscription par Western Union","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='western'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderEcolageViaWestern($data[0],$data[1],$data[2],$data[3]);
            //mail($etudiant->get//mail(),"E-media paiement ecolage par Western union","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='western'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaWestern($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement droit examen semestriel par western","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='western'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaWestern($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement droit de soutenance par western","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='western'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderRepechageViaWestern($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement repechage par western","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='western'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement certificat par western","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='western'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@g//mail.com ou +261348472828';
            break;
    }
}

?>