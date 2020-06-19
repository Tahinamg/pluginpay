<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css"/>
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/dashboard.css" />
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
        
        <li>
          <a href="#">
            <i class="fas fa-bell"></i>
            <span>notifications<span class="badge badge-danger">2</span></span>
          </a>
        </li>
        


       <!-- <li class="menu-heading">
          <h3>Classification</h3>
        </li>-->
        <li>
          <a href="#">
            <i class="fas fa-clipboard-list"></i>
            <span>Classification </span>
          </a>
        </li>
        

        <li>
          <button class="collapse-btn" aria-expanded="true" aria-label="collapse menu">
            <i class="fas fa-reply"></i>
            <span>Se Deconnecter</span>
          </button>
        </li>
        
      </ul>
    </nav>
  </header>

  <section class="col-10">
    <div class="table-responsive-xl">
      <table class="table">
        <thead>
          <tr>
            <td>id</td>
            <td>N° Matricule</td>
            <td>Nom</td>
            <td>Nationalité</td>
            <td>type</td>
            <td>Motif</td>
            <td>Reference</td>
            <td>Intitulé du compte</td>
            <td>Montant</td>
            <td>Date</td>
            <td>Inscription</td>
            <td>Ecolage</td>
            <td>DES</td>
            <td>DEF</td>
            <td>D.S</td>
            <td>Repechage</td>
            <td>Certificat</td>
            
            
          </th>
        </thead>

        <tbody>
          

         
        </tbody>
      </table>

    </div>
  </section>
</div>

 
  
</body>
<script type="text/javascript" src="JS/dasboard.js" ></script>
<script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>

</html>