<?php 

ob_start();

session_start();


if(!isset($_SESSION['matricule'],$_SESSION['inscription'])){

    header("location:Connecter");
} 
if(isset($_SESSION['matricule'],$_SESSION['inscription'])&&($_SESSION['inscription']!=0)){
    header("location:Traitement");
}

function loadclass($class){
       
    require "../Model/".$class.'.class.php';
   
}

spl_autoload_register("loadclass");
$db=MyPDO::getMysqlConnexion();
$etudiantmanager=new EtudiantManager($db);
$matricule=(string)$_SESSION["matricule"];
$data=$etudiantmanager->createEtudiant($matricule);
$etudiant=new Etudiant($data);
if($etudiant->getIdetudiants()==0){
    header("location: Connecter");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Validation d'inscription</title>
<link rel="icon" href="paiement/Vue/Image/logo E-media.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="paiement/Vue/CSS/bootstrap.min.css" />
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
<link rel="stylesheet" href="paiement/Vue/CSS/fontawesome.min.css" />
<link rel="stylesheet" href="paiement/Vue/CSS/main.css" />
</head>

<body>
    <section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 ban" style="margin-top: 5%;">
                <h3 style=" text-align: center; color: rgb(6, 153, 238); border-bottom:ridge; border-bottom-style:ridge;">VALIDATION DE VOTRE COMPTE</h3>
                <br>
                <div class="d-flex">
                    <h5>FR </h5>
                    <h5><span style="color: #2A2A2A;"> :Veuillez Validez votre inscription en payant votre frais d'inscription</span></h5>
                </div>
                <div class="d-flex">
                    <h5>MG </h5>
                    <h5><span style="color: #2A2A2A;"> :Mba ahatontosa ny fisoratana anarana dia mila aloha ny saran'ny fisoratana anarana</span></h5>
                </div>
                <div class="d-flex">
                    <h5>GB </h5>
                    <h5><span style="color: #2A2A2A;"> :Please Confirm your registration by paying your registration fees</span></h5>
                </div>
                <br>
                <h3 style="text-align: center; color: rgb(6, 153, 238); border-bottom:ridge; border-bottom-style:ridge;">PLUSIEURS MOYEN DE PAIEMENT</h3>
                <br>
                <div class="d-flex flex-column flex-md-row justify-content-center col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="d-flex flex-column align-content-center justify-content-center mx-1 paiementitem embed-responsive-item">
                    
                        <img  width="80px" height="50px" src="paiement/Vue/Image/mvola.png" alt="mvola"/>
                            
                        <em class="text-warning text-center">via mvola</em>
                    </div>
        
                    <div class="d-flex flex-column paiementitem mx-1 embed-responsive-item">
                        
                        <img width="80px" height="50px" src="paiement/Vue/Image/money-check.svg" alt="cheque"/>
                        <em class="text-primary text-center">par cheque</em>
                    </div>
        
                    <div class="d-flex flex-column paiementitem mx-1 embed-responsive-item">
                        <img width="80px" height="50px" src="paiement/Vue/Image/money-bill.svg" alt="espece"/>
        
                        <em class="text-danger text-center">par espece</em>
                    </div>
        
                    <div class=" d-flex flex-column paiementitem mx-1 embed-responsive-item">
                        <img width="80px" height="50px" src="paiement/Vue/Image/arrow-right.svg" alt="Virement"/>
                        <em class="text-success text-center">Virement bancaire</em>
                    </div>  

                </div>
                <br>
                <div class="d-flex flex-column flex-md-row justify-content-center col-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: -7%;">
                    
                    <div class=" d-flex flex-column paiementitem mx-1 embed-responsive-item">
                        <img width="80px" height="50px" src="paiement/Vue/Image/WesternUnion.png" alt="Virement"/>
                        <em class="text-center">Western Union</em>
                    </div>  

                    <div class=" d-flex flex-column paiementitem mx-1 embed-responsive-item">
                        <img width="80px" height="50px" src="paiement/Vue/Image/MoneyGram.jpg" alt="Virement"/>
                        <em class="text-danger text-center">MoneyGram</em>
                    </div> 
                </div>
                <br>
                <div align="center">
                    <!--passage vers le paiement-->
                   <a href="Traitement" class="btn btn-success" >Caisse <img src="paiement/Vue/Image/boutton.png" width="30%"></a> 
                </div>
                <br>
                <div class="d-flex" style="color: red;">
                    <h6>PS </h6>
                    <h6>: Pour le paiement par Western Union veuillez nous contacter directement sur <span style="color: black">servicefinance@e-media.mg</span> ou au <span style="color: black">034 11 777 37</span></h6>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <img class="justify-content-center img-fluid" src="paiement/Vue/Image/test.jpg"/>
            </div>
        </div>
    </div>

    <br/><br/><br/><br/>
    <br/><br/><br/><br/>
    <br/><br/><br/><br/>
    
    <div class="fixed-bottom alert alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        Les cours ne seront pas disponibles tant que vous ne payez pas votre frais d'inscription et votre première mensualité
    </div>
    
</section>
</body>

<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="paiement/Vue/JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!--
<script type="text/javascript" src="paiement/Vue/JS/jquery 3.5.1.js"></script>
<script type="text/javascript" src="paiement/Vue/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="paiement/Vue/JS/all.min.js"></script>
<script type="text/javascript" src="paiement/Vue/JS/bootstrap.min.js"></script>-->
<script type="text/javascript" src="paiement/Vue/JS/paiement.js"></script>
</html>

<?php 

ob_end_flush();

?>