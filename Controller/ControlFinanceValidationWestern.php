<?php
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
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement inscription par western union ",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de votre inscription effectu&eacute;e</h2>
    <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour la validation de votre inscription a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='western'");
            break;
        case 'ecolage' :
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderEcolageViaWestern($data[0],$data[1],$data[2],$data[3]);
            
          /*  $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement frais de scolarité par western union",'<html><body>
<div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de vos frais de scolarit&eacute; effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour vos frais de scolarit&eacute; a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            
            //mail($etudiant->get//mail(),"E-media paiement ecolage par Western union","Votre ecolage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='western'");
            break;
        case 'droit examen semestriel' : 
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaWestern($data[0],$data[1],$data[2]);
            /*$headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement droit d'examen par western union",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit d`examen effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour votre droit d`examen a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            //mail($etudiant->get//mail(),"E-media paiement droit examen semestriel par western","Votre droit pour l'examen semestriel a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='western'");
            break;
        case 'Droit de soutenance' :
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaWestern($data[0],$data[1],$data[2]);
            
         /*   $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement droit de soutenance par Western Union",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de soutenance effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour votre droit de soutenance a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);
            */
            //mail($etudiant->get//mail(),"E-media paiement droit de soutenance par western","Votre droit de soutenance a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='western'");
            break;
        case 'repechage' :
            $data=array($_POST['idetudiants'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderRepechageViaWestern($data[0],$data[1],$data[2]);
            
         /*  $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement du droit de repêchage par western union",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de repêchage effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour votre droit de repêchage a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            //mail($etudiant->get//mail(),"E-media paiement repechage par western","Votre droit de repechage a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='western'");
            break;
        case 'certificat' :
            $data=array($_POST['matricule'],$_POST['idwestern'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
            
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
mail($etudiant->getMail(),"E-media paiement certificat par western union",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  du paiement de votre certificat  effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom().' '.$etudiant->getPrenom().'</strong><br>
        Votre paiement par western union pour le paiement de votre certificat a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
            
            //mail($etudiant->get//mail(),"E-media paiement certificat par western","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='western'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@g//mail.com ou +261348472828';
            break;
    }
}

?>