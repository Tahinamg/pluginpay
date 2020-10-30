<?php
function loadclass($class)
{
    require_once "../Model/" . $class . '.class.php';
}
spl_autoload_register("loadclass");

$db = MyPDO::getMysqlConnexion();
$comptable = new ComptableManagerMobileMoney($db);
$etudiantmanager = new EtudiantManager($db);
$data = $etudiantmanager->createEtudiant($_POST['matricule']);
$etudiant = new Etudiant($data);

if (isset($_POST['motif'])) {
    switch ($_POST['motif']) {
        case 'inscription':
            $data = array($_POST['matricule'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderInscriptionViaMobileMoney($data[0], $data[1], $data[2]);
            //mail($etudiant->getMail(),"E-media paiement inscription par mobilemoney","Votre droit pour l'inscription a ete valide");
           /* $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement inscription par MVOLA", '<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de votre inscription effectu&eacute;e</h2>
    <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour la validation de votre inscription a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);*/


            header("location:../Vue/dashboard.php?status='valider'&motif='inscription'&mode='mobilemoney'");
            break;
        case 'ecolage':
            $data = array($_POST['quantite'], $_POST['matricule'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderEcolageViaMobileMoney($data[0], $data[1], $data[2], $data[3]);
            // mail($etudiant->getMail(),"E-media paiement ecolage par mobilemoney","Votre ecolage a ete valide");

           /* $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement frais de scolarité par MVOLA", '<html><body>
<div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation de vos frais de scolarit&eacute; effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour vos frais de scolarit&eacute; a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);:*/

            header("location:../Vue/dashboard.php?status='valider'&motif='ecolage'&mode='mobilemoney'");
            break;
        case 'droit examen semestriel':
            $data = array($_POST['matricule'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderDroitExamen($data[0], $data[1], $data[2]);
            // mail($etudiant->getMail(),"E-media paiement droit examen semestriel par mobilemoney","Votre droit pour l'examen semestriel a ete valide");

           /* $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement droit d'examen par MVOLA", '<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit d`examen effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour votre droit d`examen a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);*/


            header("location:../Vue/dashboard.php?status='valider'&motif='des'&mode='mobilemoney'");
            break;
        case 'Droit de soutenance':
            $data = array($_POST['matricule'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderSoutenance($data[0], $data[1], $data[2]);
            //  mail($etudiant->getMail(),"E-media paiement droit de soutenance par mobilemoney","Votre droit de soutenance a ete valide");


          /*  $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement droit de soutenance par MVOLA", '<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de soutenance effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour votre droit de soutenance a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);*/

            header("location:../Vue/dashboard.php?status='valider'&motif='ds'&mode='mobilemoney'");
            break;
        case 'repechage':
            $data = array($_POST['idetudiants'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderRepechage($data[0], $data[1], $data[2]);
            //  mail($etudiant->getMail(),"E-media paiement repechage par mobilemoney","Votre droit de repechage a ete valide");

           /* $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement du droit de repêchage par MVOLA", '<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  de votre droit de repêchage effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour votre droit de repêchage a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);*/

            header("location:../Vue/dashboard.php?status='valider'&motif='repechage'&mode='mobilemoney'");
            break;
        case 'certificat':
            $data = array($_POST['matricule'], $_POST['idmobilemoney'], $_POST['observation']);
            $comptable->ValiderCertificat($data[0], $data[1], $data[2]);

           /* $headers = "MIME-version : 1.0" . "\r\n";
            $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
            $headers .= "From: Service Finance E-media <servicefinance@e-media.mg>" . "\r\n";
            $headers .= "Reply-To : anjaranirinagael@gmail.com" . "\r\n";
            $headers .= "Bcc: anjaranirinagael@gmail.com";
            mail($etudiant->getMail(), "E-media paiement certificat par MVOLA", '<html><body><div style="flex-direction:row;display:flex;margin:0;padding:0;height: 100px; background:linear-gradient(90deg,rgb(4, 94, 110) 26%,#a5010147 150%);">
    <h1 style="width:100%;color: white; opacity: 0.8; text-align:center;font-size:40px;word-wrap: break-word;">E-media D&eacute;partement finance</h1>
   
    </div>
    <h2 style="font-size: 30px; color: green; font-weight: bolder;text-align: center; font-style: italic;">Validation  du paiement de votre certificat  effectu&eacute;e</h2>
   <p style="text-align: center; font-size: 20px;text-justify: distribute;">
        <strong>F&eacute;licitation!!!' . $etudiant->getNom() . ' ' . $etudiant->getPrenom() . '</strong><br>
        Votre paiement par MVOLA pour le paiement de votre certificat a &eacute;t&eacute; effectu&eacute;e avec succ&egrave;s.L\' universit&eacute; E-media vous remercie de votre confiance.
        <br>
    </p>
        <div style="text-align: end; font-style: italic;">
            <strong>E-media Finance</strong>
        </div></body></html>', $headers);*/


            // mail($etudiant->getMail(),"E-media paiement certificat par mobilemoney","Votre droit de certificat a ete valide");
            header("location:../Vue/dashboard.php?status='valider'&motif='certificat'&mode='mobilemoney'");
            break;
        default:
            echo 'contacter le webmester Ravelojaonanatanaela8@gmail.com ou +261348472828';
            break;
    }
}
