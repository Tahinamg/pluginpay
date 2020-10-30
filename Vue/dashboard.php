<?php
header('Content-Type:text/html ; charset=utf-8');
ob_start();
session_start();

if (!isset($_SESSION['finance'])) {

  header('location : logindahboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau du bord</title>
  <link rel="stylesheet" href="CSS/bootstrap.min.css" />
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
  <link rel="stylesheet" href="CSS/fontawesome.min.css" />
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">-->
  <link rel="stylesheet" href="CSS/dash.css" />
  <link rel="icon" href="Image/logo E-media.png" type="image/png" sizes="16x16">

<script  type="text/javascript" src="https://unpkg.com/xlsx@0.16.8/dist/xlsx.full.min.js"> </script>
<script type="text/javascript" src="JS/FileSaver.min.js"></script>
</head>

<body>

  <div id="content-wrapper" class="d-flex">
    <div id="sidebar-container" class="bg-light border-right">
      <div class="logo">
        <h4 class="font-weight-bold mb-8">E-media</h4>
      </div>
      <div class="menu list-group-flush">
        <a href="#" id="notification" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-bell lead mr-2"></i> Notifications</a>
        <div class="notificationsubmain" id="test">
          <a href="#" id="MvolaVoir" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">MVOLA
            <span class="badge badge-pill badge-light float-right mr-5" id="MvolaNotif"></span></a>
          <a href="#" id="ChequeVoir" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">CHEQUE
            <span class="badge badge-pill badge-light float-right mr-5" id="ChequeNotif"></span></a>
          <a href="#" id="VersementVoir" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">VERSEMENT <span class="badge badge-pill badge-light float-right mr-5" id="VersementNotif"></span></a>
          <a href="#" id="VirementVoir" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">VIREMENT <span class="badge badge-pill badge-light float-right mr-5" id="VirementNotif"></span></a>
          <a href="#" id="WesternVoir" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">WESTERN
            <span class="badge badge-pill badge-light float-right mr-5" id="WesternNotif"></span></a>
          <a href="#" id="MoneyGram" class="list-group-item list-group-item-action bg-light p-1 pl-5 border-0">MONEYGRAM
            <span class="badge badge-pill badge-light float-right mr-5" id="MoneyGramNotif"></span></a>
        </div>

        <a href="#" id="classification" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-clipboard-list lead mr-2"></i> Classification</a>
        <a href="#" id="stat" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-chart-bar lead mr-2"></i> Statistique</a>
        <a href="#" id="recouvrement" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-calculator lead mr-2"></i> Recouvrement</a>
        <a href="#" id="promo" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-wallet lead mr-2"></i> Code Promo</a>
       
        <a href="../Controller/DeconnexionFinance.php" class="list-group-item list-group-item-action bg-light p-3 border-0"><i class="fas fa-sign-out-alt lead mr-2"></i> Deconnection</a>
      </div>
    </div>

    <div id="page-container" class="w-100 bg-light-blue">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
          <button class="btn" id="menu-toggle"><i class="fas fa-bars lead"></i></button>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <span><i class="fas fa-user lead mr-2"></i> Gaelle</span>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <section style="height: 100vh; overflow:scroll">

        <div id="welcoming" class="container-fluid p-5">
          <div>
            <h2>Bienvenu dans le tableau de bord </h2>
          </div>
        </div>
        <br>
        <div id="containertable" class="table-responsive-xl" style="overflow-x: auto">
          <table class="table table-responsive-xl table-hover w-auto">
          </table>
        </div>

      </section>



    </div>
  </div>


</body>
<!--
<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
-->
<script type="text/javascript" src="JS/jquery 3.5.1.js"></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>

<script type="text/javascript" src="JS/Component.js"></script>
<script type="text/javascript" src="JS/AjaxNotification.js"></script>
<script type="text/javascript" src="JS/affichage.js"></script>
<script type="text/javascript" src="JS/AjaxAffichage.js"></script>

<script>
  $("#notification").click(
    function(e) {
      e.preventDefault()
      $(".notificationsubmain").slideToggle("fast");
    }
  );
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#content-wrapper").toggleClass("toggled");
  });
</script>

<?php

ob_flush();

?>

</html>