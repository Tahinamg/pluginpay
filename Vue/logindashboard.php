<?php

    ob_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to dashboard</title>
    <link rel="icon" href="Image/logo E-media.png" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/logindashboard.css"/>
<style>


</style>
</head>
<body>
    <h1>Authentification vers le tableau de bord du paiement</h1>

<div class="w-100">
   
  <form  method="POST"  action="../Controller/ControlLoginToDashboard.php" class="d-flex flex-column ">
    <input type="text" name="matricule" class="align-self-center formStyle" placeholder="Matricule (necessaire)" required />
    <input type="password" name="password" class="align-self-center formStyle" placeholder="Mot de passe (necessaire)" required />
    
    <input class="align-self-center btn btn-success formButton" type="submit" value="Entrez !!" />
  </form>
</div>


</body>
<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/paiement.js"></script>
       
       <!-- <script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/paiement.js"></script> -->
</html>
<?php

ob_end_flush();

?>