<?php
//UPLOAD
function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerCheque($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);
if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderInscriptionViaCheque($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement inscription par cheque","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='cheque'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderEcolageViaCheque($data[0],$data[1],$data[2],$data[3]);
            mail($etudiant->getMail(),"E-media paiement ecolage par cheque","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='cheque'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaCheque($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement droit examen semestriel par cheque","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='cheque'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaCheque($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement droit de soutenance par cheque","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='cheque'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderRepechageViaCheque($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement repechage par cheque","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='cheque'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idcheque'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement certificat par cheque","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='cheque'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@gmail.com ou +261348472828';
            break;
    }
}


?>