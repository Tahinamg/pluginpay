<?php
header('Content-Type:text/html ; charset=utf-8');
ob_start();
//CDN  change the local to CDN before upload
//TODO ASIVO NOTIFICATION KELY

session_start();

if(!isset($_SESSION['finance'])){
    
  header('location : logindahboard.php');
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau du bord ecolage</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css"/>
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/dashboard.css"/>
    
</head>
<body>
    <style>
        /* RESET RULES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
@import url("https://fonts.googleapis.com/css?family=Lato:400,700&display=swap");

</style>
<div class="row w-100 " style="position: relative;">
<header class="page-header px-0 col-2">
    <nav>
        <div class="d-flex flex-column my-2">
            <div class="fas fa-user fa-3x align-self-center"></div>
            <div class="align-self-center">Gaelle</div>
        </div>
    
      


      <ul class="admin-menu">

       <!-- <li class="menu-heading">
          <h3><i class="fas fa-bell"></i>notifications <span class="badge badge-danger">2</span></h3>
        </li>-->
        
        <li class="menu-heading">
          <a id="notification" href="#">
            <i class="fas fa-1x fa-bell"></i>
            <h3>notifications </h3>
          </a>
            <ul class="notificationsubmain">
              <li id="MvolaVoir" >
                <a>MVOLA  &nbsp;<span  id="MvolaNotif"></span></a>
              </li>
              <li id="ChequeVoir">
              <a>CHEQUE &nbsp;<span id="ChequeNotif"></span></a>
              </li>
              <li id="VersementVoir">
                <a>VERSEMENT &nbsp;<span  id="VersementNotif"></span></a>
                
              </li>
              <li id="VirementVoir">
                <a>VIREMENT &nbsp;<span id="VirementNotif"></span></a>
              </li>

              <li id="WesternVoir">
                <a>WESTERN &nbsp;<span id="WesternNotif"></span></a>
              </li>
            </ul>

        </li>
        


       <!-- <li class="menu-heading">
          <h3>Classification</h3>
        </li>-->
        <li class="menu-heading">
          <a href="#">
            <i class="fas fa-clipboard-list"></i>
            <h3>Classification</h3> 
          </a>
        </li>
        

        <li>
          <button class="collapse-btn text-danger" aria-expanded="true" aria-label="collapse menu">
            <i class="fas fa-reply"></i>
            <span > <a href="../Controller/DeconnexionFinance.php">Se Deconnecter</a></span>
          </button>
        </li>
        
      </ul>
    </nav>
  </header>

  <section class="col-10">


<?php
if(isset($_GET['status'],$_GET['motif'],$_GET['mode'])&&$_GET['status']=='valider'){
echo '<div class="container mt-4 notif alert-dismissible">
          <div class="alert alert-success">
          <strong>'.$_GET['status'].'!!! </strong>'.$_GET['motif'].' en mode '.$_GET['mode'].' a ete valider</div></div>';
}
if(isset($_GET['status'],$_GET['mode'])&&$_GET['status']=='refuser'){
  echo '<div class="container mt-4 notif alert-dismissible">
            <div class="alert alert-danger">
            <strong>'.$_GET['status'].'</strong> Le mode de paiement  '.$_GET['mode'].' \' a ete refuse&eacute;</div></div>';
  }

?>
<div id="welcoming">
<h1>
  Bienvenu dans le tableau de bord 
</h1>
<p>Ce site est toujours en cours de maintenace mais vous pouvez deja avoir les fonctionalit&eacute; necessaire pour l'instant</p></div>


    <div class="table-responsive-xl">
      <table class="table">
      </table>

    </div>
  </section>
</div>

 
  
</body>
<!--
<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>-->

<script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/dasboard.js" ></script>
<script type="text/javascript" src="JS/AjaxNotification.js"></script>
<script type="text/javascript" src="JS/AjaxAffichage.js"></script>

<?php

ob_flush();

?>

</html>
