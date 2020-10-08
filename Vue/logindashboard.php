
<?php
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to dashboard</title>
    <link rel="icon" href="paiement/Vue/Image/logo E-media.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="paiement/Vue/CSS/fontawesome.min.css"/>
    <!-- <link rel="stylesheet" href="CSS/logindashboard.css"/>-->
<style>


</style>
</head>
<body>
<br>
<br>
<div class="container  my-auto">
  <div class="row">
    <div class="col-0 col-sm-0 col-md-6 col-lg-6">
      <img class="img-fluid" src="paiement/Vue/Image/log.png">
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
    <div class="container">
    <br>
    <br>
  <h4 style="border-bottom-style:groove;">Authentification vers le tableau de bord du paiement</h4>
  <br>
      <form  method="POST"  action="paiement/Controller/ControlLoginToDashboard.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Matricule (necessaire)" name="matricule" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Mot de passe (necessaire)" name="password" required>
        </div>
        <input class="btn btn-info" align="center" type="submit" value="Entrez !!" />
      </form>
    </div>
  </div>
</div>

</body>

<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="paiement/Vue/JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="paiement/Vue/JS/paiement.js"></script>
       
  <!-- <script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/paiement.js"></script>-->
</html>
<?php

ob_end_flush();

?>