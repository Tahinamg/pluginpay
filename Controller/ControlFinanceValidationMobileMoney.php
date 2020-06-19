<?php

function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerMobileMoney($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);

if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idmobilemoney']);
            $comptable->ValiderInscriptionViaMobileMoney($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement inscription par mobilemoney","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='mobilemoney'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idmobilemoney']);
            $comptable->ValiderEcolageViaMobileMoney($data[0],$data[1],$data[2]);
            mail($etudiant->getMail(),"E-media paiement ecolage par mobilemoney","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='mobilemoney'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idmobilemoney']);
            $comptable->ValiderDroitExamen($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement droit examen semestriel par mobilemoney","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='mobilemoney'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idmobilemoney']);
            $comptable->ValiderSoutenance($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement droit de soutenance par mobilemoney","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='mobilemoney'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idmobilemoney']);
            $comptable->ValiderRepechage($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement repechage par mobilemoney","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='mobilemoney'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idmobilemoney']);
            $comptable->ValiderCertificat($data[0],$data[1]);
            mail($etudiant->getMail(),"E-media paiement certificat par mobilemoney","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='mobilemoney'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@gmail.com ou +261348472828';
            break;
    }
}


?>