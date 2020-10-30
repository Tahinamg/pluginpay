<?php
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
            
            /*$headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement inscription par Versement en espèces",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de votre inscription effectu&eacute;e</h2>
    <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par Versement en esp&eaces pour la validation de votre inscription a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            //mail($etudiant->get//mail(),"E-media paiement inscription par versement","Votre droit pour l'inscription a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='versement'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderEcolageViaVersement($data[0],$data[1],$data[2],$data[3]);
            //mail($etudiant->get//mail(),"E-media paiement ecolage par versement","Votre ecolage a ete valide");
            
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement frais de scolarité par versement en espèces",'<html><body>
<div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de vos frais de scolarit&eacute; effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par versement en espèces pour vos frais de scolarit&eacute; a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='versement'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaVersement($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement droit examen semestriel par versement","Votre droit pour l'examen semestriel a ete valide");
            
            /*$headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement droit d'examen par versement en espèces",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit d`examen effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par versement en espèces pour votre droit d`examen a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='versement'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaVersement($data[0],$data[1],$data[2]);
            //mail($etudiant->get//mail(),"E-media paiement droit de soutenance par versement","Votre droit de soutenance a ete valide");
            
            /*$headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement droit de soutenance par versement en espèces",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de soutenance effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par versement en espèces pour votre droit de soutenance a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='versement'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderRepechageViaVersement($data[0],$data[1],$data[2]);
            
            /*$headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement du droit de repêchage par versement en espèces ",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de repêchage effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par versement en espèces pour votre droit de repêchage a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);
            
            
            //mail($etudiant->get//mail(),"E-media paiement repechage par versement","Votre droit de repechage a ete valide");*/
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='versement'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idversement'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
            
                                               
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement certificat par Versement en espèces",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  du paiement de votre certificat  effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par Versement en espèces pour le paiement de votre certificat a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            //mail($etudiant->get//mail(),"E-media paiement certificat par versement","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='versement'");
            break;
        default:
            echo 'contacter le webmester  Ravelojaonanatanaela8@g//mail.com ou +261348472828';
            break;
    }
}


?>