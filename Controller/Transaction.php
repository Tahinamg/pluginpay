<?php
ob_start();
//UPLOAD
session_start();

function loadclass($class){
       
    require_once "../Model/".$class.'.class.php';
   
}
spl_autoload_register("loadclass");

if(!isset($_SESSION['matricule'])){
    header("location: https://www.E-media.mg");
}
$db=MyPDO::getMysqlConnexion();
//maka ilay id aloha mba ampifandraisana azy @ table resaka payement
$etudiantmanager=new EtudiantManager($db);
$data=$etudiantmanager->createEtudiant($_SESSION["matricule"]);
$etudiant=new Etudiant($data);
$mpianatra = array("id"=>$etudiant->getIdetudiants());

if($mpianatra["id"]==0){
    header("location:../Vue/paiement.php?error=1");
}
if(isset($_POST['formatpaiement'])){
    $formatpaiement=(string) $_POST['formatpaiement'];


switch ($formatpaiement) {
    case 'mvola':
        if(isset($_POST['reference'],$_POST['date'],$_POST['motif'],$_POST['montant'])){
            $regmvola='/[0-9]{5,20}/';      
            $regmotif='/inscription|ecolage|droit examen semestriel|Droit de soutenance|repechage|certificat/';

            $regmontant = '/[0-9]{1,8}/';

        if(preg_match($regmvola,$_POST['reference'])&&preg_match($regmotif,$_POST['motif'])&&preg_match($regmontant,$_POST['montant'])){
                $data = array(
                "reference"=>(string) $_POST['reference'],
                "daty"=>(string) $_POST['date'],//
                "idetudiants"=>(int) $mpianatra['id'],
                "motif"=>(string) $_POST['motif'],
                "etat"=>"non lu",
                "decision"=>"non prise",
                "montant"=>(string) $_POST['montant'],
                "observation"=>"aucun"
            );
            $mvola = new MobileMoney($data);
            $mvolamanager= new MobileMoneyManager($db);
            $mvolamanager->setMobileMoney($mvola);
            header('location:../Vue/paiement.php?error=0');
        }else{
            header('location:../Vue/paiement.php?error=1');
        } 
      
    }else{
        header('location:../Vue/paiement.php?error=1&errtype=mvola');
    }
    break;


    case 'western' :
       if(isset($_POST['nsuivi'],$_POST['nomexpediteur'],$_POST['montantwestern'],$_POST['motif'])){
            $regnsuivi='/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';
            $regnomexpediteur='/[a-zA-Z\s]+/';
            $regmontantwestern='/[0-9]+/';
            $regmotif='/inscription|ecolage|droit examen semestriel|Droit de soutenance|repechage|certificat/';

            if(preg_match($regnsuivi,$_POST['nsuivi'])&&preg_match($regnomexpediteur,$_POST['nomexpediteur'])&& preg_match($regmontantwestern,$_POST['montantwestern'])&&preg_match($regmotif,$_POST['motif'])){
                $data3= array(
                    'nsuivi'=>(string) $_POST['nsuivi'],
                    'nomexp'=>(string) $_POST['nomexpediteur'],
                    'montantwestern'=>(string) $_POST['montantwestern'],
                    'montant'=>(string) $_POST['montant'],
                    'motif'=>(string) $_POST['motif'],
                    'etat'=>"non lu",
                    'decision'=>"non prise",
                    'idetudiants'=>(int) $mpianatra['id'],
                    'observation'=>"aucun"
                );
                $western=new Western($data3);
                $westernmanager=new WesternManager($db);
                $westernmanager->setWestern($western);
                header('location:../Vue/paiement.php?error=0');
            }else{
                header('location:../Vue/paiement.php?error=1');

            }
        }else{
             header('location:../Vue/paiement.php?error=1&errtype=Western');
        }
        
    break;
   

    case 'cash':

        $regcash='/[0-9]{1,9}/';        
        $regmotif='/inscription|ecolage|droit examen semestriel|Droit de soutenance|repechage|certificat/';
        $regmontant = '/[0-9]{1,8}/';
        $regagence='/[A-Za-z]{2,20}/';

        if(preg_match($regcash,$_POST['nrecu'])&&preg_match($regmotif,$_POST['motif'])&&preg_match($regmontant,$_POST['montant'])&&preg_match($regagence,$_POST['agence'])){
       
        if(isset($_POST['nrecu'],$_POST['date'],$_POST['agence'],$_POST['motif'],$_POST['montant'])){
        $data = array(
            "nbordereaux"=>(string) $_POST['nrecu'],
            "daty"=>(string) $_POST['date'],
            "agence"=>(string) $_POST['agence'],
            "motif"=>(string) $_POST['motif'],
            "etat"=>"non lu",
            "decision"=>"non prise",
            "montant"=>(string) $_POST['montant'],
            "idetudiants"=>(int) $mpianatra['id'],
            "observation"=>"aucun"
        );
        $versement= new Versement($data);
        $versementmanager=new VersementManager($db);
        $versementmanager->setVersement($versement);
        header('location:../Vue/paiement.php?error=0');
    }else{
        header('location:../Vue/paiement.php?error=1');

    }
        
    }else{
        header('location:../Vue/paiement.php?error=1&errtype=versement');
    }
    break;
    case 'cheque':

        $regtireur='/[a-zA-Z]{1,20}/';
        $regetablissement='/[a-zA-Z]{1,15}/';

        $regmotif='/inscription|ecolage|droit examen semestriel|Droit de soutenance|repechage|certificat/';
        $regmontant = '/[0-9]{1,8}/';
        $regncheque='/[0-9]{2,20}/';
        if(isset($_POST['tireur'],$_POST['etablissement'],$_POST['ncheque'],$_POST['motif'],$_POST['montant'])){
        
            if(preg_match($regtireur,$_POST['tireur'])&&preg_match($regetablissement,$_POST['etablissement'])&&preg_match($regmotif,$_POST['motif'])&&preg_match($regmontant,$_POST['montant'])&&preg_match($regncheque,$_POST['ncheque'])){
        

       
                $data=array(
                    "tireur"=>(string) $_POST['tireur'],
                    "etablissement"=>(string) $_POST['etablissement'],
                    "ncheque"=>(string) $_POST['ncheque'],
                    "idetudiants"=>(int) $mpianatra['id'],
                    "motif"=>(string) $_POST['motif'],
                    "etat"=>"non lu",
                    "decision"=>"non prise",
                    "montant"=>(string) $_POST['montant'],
                    "observation"=>"aucun"
                );
                $cheque=new Cheque($data);
                $chequemanager = new ChequeManager($db);
                $chequemanager->setCheque($cheque);
                header('location:../Vue/paiement.php?error=0');

            }else{
            header('location:../Vue/paiement.php?error=1');

        }
        }else{
            header('location:../Vue/paiement.php?error=1&errtype=cheque');
        }

    break;
      
    case 'virement':
        if(isset($_POST['ncompte'],$_POST['tcompte'],$_POST['motif'],$_POST['montant'],$_POST['datevirement'])){
       $regncompte='/[0-9 \s]{15,25}/';
        $regtcompte='/[a-zA-Z]{2,20}/';
        $regmotif='/inscription|ecolage|droit examen semestriel|Droit de soutenance|repechage|certificat/';
        $regmontant = '/[0-9]{1,8}/';
        if(preg_match($regncompte,$_POST['ncompte'])&&preg_match($regtcompte,$_POST['tcompte'])&&preg_match($regmotif,$_POST['motif'])&&preg_match($regmontant,$_POST['montant'])){
            $data=array(
                "ncompte"=>(string) $_POST['ncompte'],
                "titucompte"=>(string) $_POST['tcompte'],
                "idetudiants"=>(int) $mpianatra['id'],
                "motif"=>(string) $_POST['motif'],
                "etat"=>"non lu",
                "decision"=>"non prise",
                "montant"=>(string) $_POST['montant'],
                "datevirement"=>(string) $_POST['datevirement'],
                "observation"=>"aucun"

            );
            $virement=new Virement($data);
            $virementmanager=new VirementManager($db);
            $virementmanager->setVirement($virement);
            header('location:../Vue/paiement.php?error=0');
        }else{
        header('location:../Vue/paiement.php?error=1');
        }
    }else{
        header('location:../Vue/paiement.php?error=1&errtype=virement');
    }
    
    break;
  
}
}else{
    header('location:../Vue/paiement.php?error=1&errtype=formatpaiement');
}


ob_end_flush();

?>