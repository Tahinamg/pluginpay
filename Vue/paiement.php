
<?php
//CDN Change the local  to CDN before upload
//UPLOAD
ob_start();

header('Content-Type:text/html ; charset=utf-8');

function loadclass($class){
    require "../Model/".$class.'.class.php';
}
spl_autoload_register("loadclass");
include "../Controller/AccesPaiement.php";   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Image/logo E-media.png" type="image/png" sizes="16x16"> 

    <title>Paiement</title>
    <link rel="stylesheet" href="CSS/loading.css" type="text/css"/>
   <link rel="stylesheet" href="CSS/bootstrap.min.css"/>
   <!--   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/main.css" />
</head>
<body>
    <div id="loading">
  <?php echo'<?xml version="1.0" encoding="UTF-8" standalone="no"?>'?>
<svg id="loader"
   xmlns:dc="http://purl.org/dc/elements/1.1/"
   xmlns:cc="http://creativecommons.org/ns#"
   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
   xmlns:svg="http://www.w3.org/2000/svg"
   xmlns="http://www.w3.org/2000/svg"
   xmlns:xlink="http://www.w3.org/1999/xlink"
   xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
   xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
   sodipodi:docname="Loader.svg"
   inkscape:version="1.0 (6e3e5246a0, 2020-05-07)"
   id="svg8"
   version="1.1"
   viewBox="0 0 297 92"
   height="92mm"
   width="297mm">
  <defs
     id="defs2">
    <linearGradient
       id="linearGradient24"
       inkscape:collect="always">
      <stop
         id="stop20"
         offset="0"
         style="stop-color:#0000d1;stop-opacity:1" />
      <stop
         style="stop-color:#2c2ae3;stop-opacity:1"
         offset="0.2490395"
         id="stop30" />
      <stop
         style="stop-color:#690e41;stop-opacity:0.89803922"
         offset="0.74368078"
         id="stop28" />
      <stop
         id="stop22"
         offset="1"
         style="stop-color:#6d001b;stop-opacity:0.98823529" />
    </linearGradient>
    <rect
       id="rect12"
       height="33.568283"
       width="117.24554"
       y="61.503849"
       x="67.447067" />
    <linearGradient
       gradientUnits="userSpaceOnUse"
       y2="79.050186"
       x2="171.81123"
       y1="73.175713"
       x1="75.364067"
       id="linearGradient26"
       xlink:href="#linearGradient24"
       inkscape:collect="always" />
  </defs>
  <sodipodi:namedview
     inkscape:window-maximized="1"
     inkscape:window-y="34"
     inkscape:window-x="0"
     inkscape:window-height="781"
     inkscape:window-width="1600"
     height="209mm"
     showgrid="false"
     inkscape:document-rotation="0"
     inkscape:current-layer="text10"
     inkscape:document-units="mm"
     inkscape:cy="363.92656"
     inkscape:cx="840.4063"
     inkscape:zoom="0.7"
     inkscape:pageshadow="2"
     inkscape:pageopacity="0.0"
     borderopacity="1.0"
     bordercolor="#666666"
     pagecolor="#ffffff"
     id="base" />
  <metadata
     id="metadata5">
    <rdf:RDF>
      <cc:Work
         rdf:about="">
        <dc:format>image/svg+xml</dc:format>
        <dc:type
           rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
        <dc:title></dc:title>
      </cc:Work>
    </rdf:RDF>
  </metadata>
  <g
     id="layer1"
     inkscape:groupmode="layer"
     inkscape:label="Calque 1">
    <g id="ground"
       style="font-size:25.4px;line-height:1.25;font-family:sans-serif;-inkscape-font-specification:'sans-serif, Normal';white-space:pre;fill:#11d13b05;fill-opacity:1"
       id="text10"
       transform="matrix(2.1121103,0,0,2.1121103,-106.13642,-112.61819)"
       aria-label="E-MEDIA">
      <path
         id="path857"
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal" stroke-width="0.2" stroke="rgb(42, 45, 190)" d="M 69.530859,84.993945 V 67.010547 h 13.146485 v 2.108398 H 71.763281 v 5.692676 h 8.421191 v 2.108398 h -8.421191 v 5.965528 h 10.914063 v 2.108398 z" />
      <path
         id="path859" stroke-width="0.2" stroke="rgb(42, 45, 190)"
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="m 84.67412,79.4625 v -2.108399 h 6.858496 V 79.4625 Z" />
      <path
         id="path861" stroke-width="0.2" stroke="rgb(42, 45, 190)" 
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="M 94.236326,84.993945 V 67.010547 h 2.232422 l 6.436812,16.333886 6.43682,-16.333886 h 2.23242 v 17.983398 h -2.23242 V 73.038086 l -4.63848,11.955859 h -3.59668 L 96.468748,73.038086 v 11.955859 z" />
      <path
         id="path863" stroke-width="0.2" stroke="rgb(42, 45, 190)" 
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="M 115.61797,84.993945 V 67.010547 h 13.14648 v 2.108398 h -10.91406 v 5.692676 h 8.42119 v 2.108398 h -8.42119 v 5.965528 h 10.91406 v 2.108398 z" />
      <path
         id="path865" stroke-width="0.2" stroke="rgb(42, 45, 190)" 
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="m 147.07031,75.903027 q 0,9.090918 -8.4708,9.090918 h -6.56084 V 67.010547 h 6.26318 q 2.05879,0 3.59668,0.446484 1.55029,0.446485 2.51768,1.21543 0.97978,0.768945 1.57509,1.922363 0.60772,1.153418 0.84336,2.430859 0.23565,1.265039 0.23565,2.877344 z m -2.23242,-0.03721 q 0,-1.562695 -0.37207,-2.75332 -0.37207,-1.203028 -0.99219,-1.947168 -0.60772,-0.744141 -1.47588,-1.21543 -0.86816,-0.471289 -1.77354,-0.644922 -0.90537,-0.186035 -1.95957,-0.186035 h -3.99355 v 13.766602 h 4.05557 q 1.46347,0 2.61689,-0.384473 1.16582,-0.396875 2.04639,-1.203027 0.89297,-0.818555 1.36426,-2.195215 0.48369,-1.37666 0.48369,-3.237012 z" />
      <path
         id="path867" stroke-width="0.2" stroke="rgb(42, 45, 190)" 
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="m 156.06201,82.885547 v 2.108398 h -7.4414 v -2.108398 h 2.60449 V 69.118945 h -2.60449 v -2.108398 h 7.4414 v 2.108398 h -2.60449 v 13.766602 z" />
      <path
         id="path869" stroke-width="0.2" stroke="rgb(42, 45, 190)" 
         style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:25.4px;font-family:Loma;-inkscape-font-specification:'Loma, Normal';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-east-asian:normal"
         d="m 173.31367,84.993945 h -2.54248 l -2.35645,-5.915918 h -7.10654 l -2.35644,5.915918 h -2.54248 l 7.18095,-17.983398 h 2.54248 z m -8.4584,-14.795996 -2.70371,6.77168 h 5.41983 z" />
    </g>
  </g>
</svg>
    </div>
<div id="contenupaiement">
                    <div class="d-flex justify-content-end" style="border-bottom-style: solid; border-bottom-color: #f1f1f1; margin-top:10px;">
                        <a href="Deconnexion.php" style=" margin-right: 5%;">
                            <button type="button" class="btn btn-outline-info" style="margin-bottom: 10px;">Se deconnecter</button>
                        </a>
                    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 T1" style=" flex: 1;">
            <br>
            <br>
                <h5 class="text-primary text-center" style="border-bottom-style:groove;">CHOISISSEZ VOTRE MOYEN DE PAIEMENT : </h5>
                <br>
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']==0){
                            echo '<div class="p-absolute">
                            <div class="toast mt-3 bg-primary">
                                <div class="toast-header text-success font-weight-bolder">
                                <i class="fas fa-check"></i>  Paiement r&eacute;ussi
                                </div>
                                <div class="toast-body text-light font-weight-bolder">
                                    La validation de votre paiement se fera au plus tard dans les 24 heures qui suivent.
                                </div>
                            </div>
                        </div>';
                        }else{
                            echo '<div class="p-absolute">
                            <div class="toast mt-3 bg-warning">
                                <div class="toast-header font-weight-bolder">
                                Erreur du paiement
                                </div>
                                <div class="toast-body text-light font-weight-bolder">
                                <strong>Une erreur est survenue lors de votre paiement</strong>
                                    veuillez bien remplir les formulaires et de r&eacute;essayer &agrave; nouveau. Si les probl&egrave;mes p&eacute;rsistent, appeler les services techniques +261348472828
                                </div>
                            </div>
                        </div>';
                        }
                    }
                ?>
                <?php
                    if($mpianatra['nationalite']=='MG'){
                        echo '
                        <div>
                    <button id="mvolacash" class="BouttonPaiement btn btn-warning text-light hvr-bounce-in align-items-center">
                        Payer via Mvola
                    </button>
                    </div>
                    
                    <div>
                        <button  id="cash" class="BouttonPaiement btn btn-danger hvr-bounce-in align-items-center">
                            Versement En Espece &agrave; la banque
                        </button>
                    </div>';
                    }?>
                <div>
                    <button id="cheque" class="BouttonPaiement btn btn-primary text-light hvr-bounce-in align-items-center">
                        Payer Par cheque
                    </button>
                </div>
                <div >
                    <button id="virement" class="BouttonPaiement btn btn-success hvr-bounce-in align-items-center">
                        Payer Par Virement Bancaire
                    </button> 
                </div>
                <div>
                    <button id="western" class="BouttonPaiement btn btn-dark text-warning font-weight-bold hvr-bounce-in align-items-center" data-toggle="modal" data-target="#Modal">
                        Western Union
                    </button> 

                    <!-- Modal -->
                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-primary text-center" id="exampleModalLabel">PAIEMENT VIA WESTERN UNION</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 align="center">Pour effectuer le paiement par Western Union veuillez nous contacter directement sur :</h5>
                                <br>
                                <div class="d-flex">
                                    <img width="25px" src="Image/mail.png">
                                    <h6 style="margin-left: 5px;">: servicefinance@e-media.mg</h6>
                                </div>
                                <div class="d-flex">
                                    <img width="25px" src="Image/tel.png">
                                    <h6 style="margin-left: 5px;">: 034 40 130 64</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <!--Fin Modal -->
                </div>
                <div >
                    <button id="MoneyGram" class="BouttonPaiement btn btn-info hvr-bounce-in align-items-center">
                        Payer Par MoneyGram
                    </button> 
                </div>
                <br>
                <h5 class="text-primary text-center" style="border-bottom-style:ridge;">
                        NUMERO DU COMPTE POUR CHAQUE MODE DE PAIEMENT :
                    </h5>
                    <br>
                    <dl class="text-center">
                        <?php
                        if($mpianatra['nationalite']=='MG'){
                            echo"
                        <dt>MVOLA</dt>
                        <dd>034 57 777 01 Au nom de Rojomalala</dd>
                        <dt>VERSEMENT EN ESPECE A LA BANQUE,CHEQUE,VIREMENT BANCAIRE</dt>
                        
                        <dd>Compte SG MADAGASCAR - ANTANANARIVO - AMBANIDIA <BR/>00008 - 00019 - 04506001603 39</dd>";
                        } else{
                            echo "CHEQUE,VIREMENT BANCAIRE</dt>
                        
                            <dd>Compte SG MADAGASCAR - ANTANANARIVO - AMBANIDIA <BR/>00008 - 00019 - 04506001603 39</dd>";
                        }
                        ?>   

                    </dl>
                
            
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-8">
            <br>
            <div class="row">
                <div class="col-1 col-sm-1 col-md-1 col-lg-2"></div>
                <div class="col-11 col-sm-11 col-md-11 col-lg-10">
                <form action="../Controller/Transaction.php" method="POST" >

                    

                    <div class="input-group mb-3 input-group-lg">
                        <input type="hidden" name="montant" 
                        <?php
                                if($mpianatra['nationalite']=='MG' && ($mpianatra['semestre']=='S1'|| $mpianatra['semestre']=='S2'||$mpianatra['semestre']=='S3' || $mpianatra['semestre']=='S4' || $mpianatra['semestre']=='S5'||$mpianatra['semestre']=='S6')){ 
                                    //reduction sur le montant s'il est deja inscri

                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo 'value=95000';
                                        }else{
                                            echo 'value=190000';
                                        }
                                    }else{
                                        echo 'value=190000';
                                    }
                                    

                                }else if($mpianatra['nationalite']=='MG' && ($mpianatra['semestre']=='S7'|| $mpianatra['semestre']=='S8'||$mpianatra['semestre']=='S9'||$mpianatra['semestre']=='S10') ){
                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo 'value=100000';
                                        }else{
                                            echo 'value=200000';
                                        }
                                    }else{
                                        echo 'value=200000';
                                    }

                                }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=='S1'|| $mpianatra['semestre']=='S2'||$mpianatra['semestre']=='S3' || $mpianatra['semestre']=='S4' || $mpianatra['semestre']=='S5'||$mpianatra['semestre']=='S6')){
                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo 'value=50';
                                        }else{
                                            echo 'value=100';
                                        }
                                    }else{
                                        echo 'value=100';
                                    }
                                }else{
                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo 'value=60';
                                        }else{
                                            echo 'value=120';
                                        }
                                    }else{
                                        echo 'value=120';
                                    }
                                }
                            ?>
                        class="form-control">
                    </div>

                    
                        <label class="font-weight-bolder fa-2x">Motifs</label>
                        <div id="motif" class="d-flex flex-column flex-wrap ">
                              
                            <div class="custom-control flex-fill form-check-inline custom-radio">
                            <input type="radio" class="custom-control-input" id="customradio1" checked name="motif" <?php 
                            //inscription selon semestre et  nationalite
                            if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S7"||$mpianatra['semestre']=="S8"||$mpianatra['semestre']=="S9"||['semestre']=="S10")){

                                //Reduction raha efa nanao inscription izy

                                if($inscri[0]>=1){
                                    $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                    if($inscriplusieursfois>1){
                                        echo 'data-value="100000"';
                                    }else{
                                        echo 'data-value="200000"';
                                    }
                                }else{
                                    echo 'data-value="200000"';
                                }
                            }else if($mpianatra['nationalite']=='MG')
                            { 
                                if($inscri[0]>=1){
                                    $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                    if($inscriplusieursfois>1){
                                        echo 'data-value="95000"';
                                    }else{
                                        echo 'data-value="190000"';
                                    }
                                }else{
                                    echo 'data-value="190000"';
                                }
                            }
                            else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S7"||$mpianatra['semestre']=="S8"||$mpianatra['semestre']=="S9"||['semestre']=="S10")){
                                if($inscri[0]>=1){
                                    $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                    if($inscriplusieursfois>1){
                                        echo 'data-value="50"';
                                    }else{
                                        echo 'data-value="100"';
                                    }
                                }else{
                                    echo 'data-value="100"';
                                }
                            } else{
                                if($inscri[0]>=1){
                                    $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                    if($inscriplusieursfois>1){
                                        echo 'data-value="60"';
                                    }else{
                                        echo 'data-value="120"';
                                    }
                                }else{
                                    echo 'data-value="120"';
                                }
                            }
                            ?>value="inscription">
                            <label class="custom-control-label" for="customradio1" >Droit d'inscription ou de reinscription
                                 <?php 
                                    if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S7"||$mpianatra['semestre']=="S9")){
                                        if($inscri[0]>=1){
                                            $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                            if($inscriplusieursfois>1){
                                                echo' 100 000 ARIARY';
                                            }else{
                                                echo' 200 000 ARIARY';
                                            }
                                        }else{
                                            echo' 200 000 ARIARY'; 
                                        }
                                        
                                    }else if($mpianatra['nationalite']=='MG'){
                                        if($inscri[0]>=1){
                                            $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                            if($inscriplusieursfois>1){
                                                echo ' 95 000 ARIARY';
                                            }else{
                                                echo ' 190 000 ARIARY';
                                            }
                                        }else{
                                            echo ' 190 000 ARIARY';
                                        }
                                    }
                                    else{
                                        if($inscri[0]>=1){
                                            $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                            if($inscriplusieursfois>1){
                                                echo "50 €";
                                            }else{
                                                echo "100 €";
                                            }
                                        }else{
                                            echo "100 €";
                                        }
                                     
                                    }?> 
                                (montant réservé aux étudiants ayant choisi 2 filières)</label>
                            </div>

                            <div class="custom-control flex-fill form-check-inline custom-radio">
                            <input type="radio" class="custom-control-input" id="customradio2" value="ecolage" 
                            <?php 
                                    /*ecolage  data-value mpianatra locale ->critere semestre*/
                                    if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S1"||$mpianatra['semestre']=="S2")){
        
                                            echo' data-value="200000" ';
                                        }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S3"||$mpianatra['semestre']=="S4")){
                                            echo ' data-value="200000"';
                                            }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S5"||$mpianatra['semestre']=="S6")){
                                            echo ' data-value="200000"';
                                             
                                            }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S7"||$mpianatra['semestre']=="S8")){
                                                echo  'data-value="220000"';
                                            }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S9"||$mpianatra['semestre']=="S10")){
                                                echo  'data-value="220000"';
                                                
                                            }/*ecolage data-value  mpianatra etranger ->critere semestre*/
                                            else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S1"||$mpianatra['semestre']=="S2")){
                                                echo  'data-value="100"';
                                            }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S3"||$mpianatra['semestre']=="S4")){
                                                echo  'data-value="100"';
                                            }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S5"||$mpianatra['semestre']=="S6")){
                                                echo  'data-value="100"';
        
                                            }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S8"||$mpianatra['semestre']=="S7")){
                                                echo  'data-value="140"';
        
                                            }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S10"||$mpianatra['semestre']=="S9")){
                                                echo  'data-value="140"';
        
                                            }
                                            
                                            ?>
                            name="motif">
                            <label class="custom-control-label" for="customradio2">Ecolage 
                                
                            <?php
                            /*ecolage mpianatra locale ->critere semestre*/
                            if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S1"||$mpianatra['semestre']=="S2")){

                                    echo' (200 000 ARIARY ~ 1 mois) ';
                                }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S3"||$mpianatra['semestre']=="S4")){
                                    echo ' (200 000 ARIARY ~ 1 mois)';
                                    }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S5"||$mpianatra['semestre']=="S6")){
                                    echo ' (200 000 ARIARY ~ 1 mois)';
                                     
                                    }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S7"||$mpianatra['semestre']=="S8")){
                                        echo  '(220 000 ARIARY ~ 1 mois)';
                                    }else if($mpianatra['nationalite']=='MG'&&($mpianatra['semestre']=="S9"||$mpianatra['semestre']=="S10")){
                                        echo  '(220 000 ARIARY ~ 1 mois)';
                                        
                                    }/*ecolage mpianatra etranger ->critere semestre*/
                                    else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S1"||$mpianatra['semestre']=="S2")){
                                        echo  '(100 € ~ 1 mois)';
                                    }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S3"||$mpianatra['semestre']=="S4")){
                                        echo  '(100 € ~ 1 mois)';
                                    }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S5"||$mpianatra['semestre']=="S6")){
                                        echo  '(100 € ~ 1 mois)';
                                    }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S8"||$mpianatra['semestre']=="S7")){
                                        echo  '(140 € ~ 1 mois)';
                                    }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=="S10"||$mpianatra['semestre']=="S9")){
                                        echo  '(140 € ~ 1 mois)';
                                    }
                                    
                                    ?>
                        
                            </label>
                            </div>

                            <div class="custom-control flex-fill form-check-inline custom-radio">
                                <input type="radio" class="custom-control-input" id="customradio3" value="droit examen semestriel" 
                                <?php
                                //EXAMEN SEMESTRIEL
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo 'data-value="20000"';}
                                else{
                                    echo 'data-value="30"';
                                } 
                            ?>
                                name="motif">
                                <label class="custom-control-label" for="customradio3">Droit d'examen semestriel 
                                    
                                <?php
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo '(20 000 ARIARY ~ 4 mois)';}
                                else{
                                    echo '(30 € ~ 4 mois)';
                                } 
                            ?>
                                </label>
                            </div>

                            
                            <div class="custom-control flex-fill form-check-inline custom-radio">
                                <input type="radio" class="custom-control-input" id="customradio5" 
                                <?php
                                //DROIT DE SOUTENANCE
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo 'data-value="100000"';}
                                else{
                                    echo 'data-value="50"';
                                } 
                            ?> value="Droit de soutenance" name="motif">
                                <label class="custom-control-label" for="customradio5">Droit de soutenance</label>
                            </div>

                            <div class="custom-control flex-fill form-check-inline custom-radio">
                                <input type="radio" class="custom-control-input" id="customradio6" 
                                
                                <?php
                                //REPECHAGE
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo 'data-value="'.($mpianatra['repechage']*20000).'"';}
                                else{
                                    echo 'data-value="'.($mpianatra['repechage']*30).'"';}
                                
                                 
                            ?>
                                value="repechage" name="motif">
                                <label class="custom-control-label" for="customradio6">Droit de repechages 
                                <?php
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo '(20 000 ARIARY/matières à repech&eacute;)';}
                                else{
                                    echo '(30 € /matières à repech&eacute;) ';
                                } 
                            ?>
                            </label>
                            </div>

                            <div class="custom-control flex-fill form-check-inline custom-radio">
                                <input type="radio" class="custom-control-input" id="customradio7" value="certificat" 
                                <?php
                                if($mpianatra['nationalite']=='MG')
                                { 
                                    echo 'data-value="5000"';}
                                else{
                                    echo 'data-value="5"';
                                } 
                            ?>
                                name="motif">
                                <label class="custom-control-label" for="customradio7">Certificat de scolarit&eacute; </label>
                            </div>


                        </div>
                
                    <!--identifier le format du paiement-->

                    <div class="form-group">
                        <input type="hidden" class="form-control"  id="formatpaiement" placeholder="1" name="formatpaiement" value="null" required>
                    </div>
                    
                    <div id="refpromo" class="form-group"> 
                        <label for="checkpromo">Activez promo</label> <input type="checkbox" id="checkpromo" name="promotion" value="true" class="form-check-inline"/> <br/> <input type="text" class="form-control" placeholder="Entrez votre Promo" name="codepromo" id="codepromo" disabled="disabled" />
                        <div>
                            <strong class="text-danger invalidpromo" style="display:none;" >Votre Code promo est invalide</strong>
                            <strong class="text-success validpromo" style="display:none;" >Code promo valide</strong>
                        </div>
                    </div>
                    <?php
                                if($mpianatra['nationalite']=='MG' && ($mpianatra['semestre']=='S1'|| $mpianatra['semestre']=='S2'||$mpianatra['semestre']=='S3' || $mpianatra['semestre']=='S4' || $mpianatra['semestre']=='S5'||$mpianatra['semestre']=='S6')){ 
                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo '<h3>Total montants : <strong id="Panier">95000 </strong><span> ARIARY</span></h3>';
                                        }else{
                                            echo '<h3>Total montants : <strong id="Panier">190000 </strong><span> ARIARY</span></h3>';
                                        }
                                    }else{
                                        echo '<h3>Total montants : <strong id="Panier">190000 </strong><span> ARIARY</span></h3>';
                                    }
                                   

                                }else if($mpianatra['nationalite']=='MG' && ($mpianatra['semestre']=='S7'|| $mpianatra['semestre']=='S8'||$mpianatra['semestre']=='S9'||$mpianatra['semestre']=='S10') ){

                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo '<h3>Total montants : <strong id="Panier">100000 </strong><span> ARIARY</span></h3>';
                                        }else{
                                            echo '<h3>Total montants : <strong id="Panier">200000 </strong><span> ARIARY</span></h3>';
                                        }
                                    }else{
                                        echo '<h3>Total montants : <strong id="Panier">200000 </strong><span> ARIARY</span></h3>'; 
                                    }

                                    

                                }else if($mpianatra['nationalite']!=='MG'&&($mpianatra['semestre']=='S1'|| $mpianatra['semestre']=='S2'||$mpianatra['semestre']=='S3' || $mpianatra['semestre']=='S4' || $mpianatra['semestre']=='S5'||$mpianatra['semestre']=='S6')){

                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo'<h3>Total montants : <strong id="Panier">50 </strong><span> €</span></h3>';

                                        }else{
                                            echo'<h3>Total montants : <strong id="Panier">100 </strong><span> €</span></h3>';

                                        }
                                    }else{
                                        echo'<h3>Total montants : <strong id="Panier">100 </strong><span> €</span></h3>';
                                    }
                                    
                                }else{
                                    if($inscri[0]>=1){
                                        $inscriplusieursfois=$etudiantmanager->inscriPlusieursFois($donne);
                                        if($inscriplusieursfois>1){
                                            echo'<h3>Total montants : <strong id="Panier">60 </strong><span> €</span></h3>';

                                        }else{
                                            echo'<h3>Total montants : <strong id="Panier">120 </strong><span> €</span></h3>';

                                        }
                                    }else{
                                        echo'<h3>Total montants : <strong id="Panier">120 </strong><span> €</span></h3>';
                                    }
                                }
                            ?>
                    
                    <div class="d-flex justify-content-end">
                        <button style="opacity: 0;" disabled class="btn validation btn-success">
                            Validez!
                        </button>
                    </div>
                   
                </form>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-1"></div>
            </div>
                

            </div>
        </div>
    </div>
</div>    
</body>
 <script src="JS/loading.js" type="text/javascript" defer></script> 

<!--
<script
	src="https://code.jquery.com/jquery-3.5.1.min.js"
	integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
	crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@popperjs/core@2" async="false"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> -->

<!--<script type="text/javascript" src="JS/paiement.js" ></script>-->
<script type="text/javascript" src="JS/jquery 3.5.1.js" ></script>
<script type="text/javascript" src="node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="JS/all.min.js"></script>
<script type="text/javascript" src="JS/bootstrap.min.js"></script>
<script type="text/javascript" src="JS/paiement.js" defer></script>
<script type="text/javascript" src="JS/AjaxPromotion.js"></script>

</html>

<?php 

ob_end_flush();
?>