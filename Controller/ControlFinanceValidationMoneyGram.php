<?php
function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

$db=MyPDO::getMysqlConnexion();
$comptable=new ComptableManagerMoneyGram($db);
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant=new Etudiant($data);

if(isset($_POST['motif'])){
    switch ($_POST['motif']) {
        case 'inscription':
            $data=array($_POST['matricule'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderInscriptionViaMoneyGram($data[0],$data[1],$data[2]);
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";

            mail($etudiant->getMail(),"E-media paiement inscription par MoneyGram",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
            <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
           
            </div>
            <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de votre inscription effectu&eacute;e</h2>
            <p style="text-align: center; font-size: 20px;text-justify: distribute;">
                <strong>F&eacute;licitation!!! '.$etudiant->getNom().' '.$etudiant->getPrenom().' </strong><br>
                Votre paiement par MoneyGram pour la validation de votre inscription a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
                <br>
            </p>
            <div style="text-align: end; font-style: italic;">
                    <strong>E-media Finance</strong>
            </div></body></html>',$headers);*/
            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='moneygram'");
            break;
        case 'ecolage':
            $data=array($_POST['quantite'],$_POST['matricule'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderEcolageViaMoneyGram($data[0],$data[1],$data[2],$data[3]);
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";

            mail($etudiant->getMail(),"E-media paiement frais de scolarité par MoneyGram",'<html><body>
            <div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
                <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
            </div>
            <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de vos frais de scolarit&eacute; effectu&eacute;e</h2>
             <p style="text-align: center; font-size: 20px;text-justify: distribute;">
                <strong>F&eacute;licitation!!!'.$etudiant->getNom()." ".$etudiant->getPrenom().'</strong><br>
                Votre paiement par MoneyGram pour vos frais de scolarit&eacute; a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
                <br>
            </p>
            <div style="text-align: end; font-style: italic;">
                <strong>E-media Finance</strong>
            </div></body></html>',$headers);*/
           
            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='moneygram'");
        break;
        case 'droit examen semestriel' :
            $data=array($_POST['matricule'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderDroitExamenViaMoneyGram($data[0],$data[1],$data[2]);
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(),"E-media paiement droit d'examen par MoneyGram",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit d`examen effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom()." ".$etudiant->getPrenom().'</strong><br>
        Votre paiement par MoneyGram pour votre droit d`examen a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
           
           
            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='moneygram'");
        break;
        case 'Droit de soutenance':
            $data=array($_POST['matricule'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderSoutenanceViaMoneyGram($data[0],$data[1],$data[2]);
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";

            mail($etudiant->getMail(),"E-media paiement droit de soutenance par MoneyGram",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de soutenance effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!'.$etudiant->getNom()." ".$etudiant->getPrenom().'</strong><br>
        Votre paiement par MoneyGram pour votre droit de soutenance a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
          
            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='moneygram'");
            break;
        case 'repechage':
            $data=array($_POST['idetudiants'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderRepechageViaMoneyGram($data[0],$data[1],$data[2]);
           /* $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(),"E-media paiement du droit de repêchage par MoneyGram",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de repêchage effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!</strong><br>
        Votre paiement par MoneyGram pour votre droit de repêchage a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
          
            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='moneygram'");
            break;
        case 'certificat':
            $data=array($_POST['matricule'],$_POST['idmoneygram'],$_POST['observation']);
            $comptable->ValiderCertificat($data[0],$data[1],$data[2]);
          /*  $headers= "MIME-version : 1.0"."\r\n";
            $headers.= "Content-type: text/html; charset=utf-8"."\r\n";
            $headers.= "From: Service Finance E-media <servicefinance@e-media.mg>"."\r\n";
            $headers.= "Reply-To : anjaranirinagael@gmail.com"."\r\n";
            $headers.= "Bcc: anjaranirinagael@gmail.com";


            mail($etudiant->getMail(),"E-media paiement certificat par MoneyGram",'<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  du paiement de votre certificat  effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!</strong><br>
        Votre paiement par MoneyGram pour le paiement de votre certificat a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>',$headers);*/
        header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='moneygram'");
    break;
    default:
    echo 'contacter le webmester Ravelojaonanatanaela8@gmail.com ou +261348472828';
    break;
    }
}


?>