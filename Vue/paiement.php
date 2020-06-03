<?php
//TODO uploadena
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
   
 <!--  <link rel="stylesheet" href="CSS/bootstrap.min.css"/>-->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="CSS/fontawesome.min.css"/>
    <link rel="stylesheet" href="CSS/main.css" />
  
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm bg-light navbar-dark">
            <a href="Deconnexion.php">
            <img src="Image/logo E-media.png" alt="E-media" style="width:100px;">
        </a>
        </nav> 
    </header>
    <section >
       <div class="d-flex flex-md-row flex-column-reverse">
           <!--a changer-->
           <div class="col-md-6 col-12">
               
                    <h4 class="text-primary text-center" >
                        Numero du compte pour chaque mode payement :
                    </h4>
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
                
            
                <form action="yourtransaction.php" method="POST" >

                    

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
                                </label>
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
                        <button style="opacity: 0;" class="btn validation font-weight-bold btn-success">
                            VALIDER
                        </button>
                    </div>
                    
                </form>
            </div>
                <!--choix du paiement-->
        <div class="col-md-6 col-12">
            <h3 class="text-danger">Choisissez votre moyen de payement : </h3>
            <?php
if(isset($_GET['error'])){
    if($_GET['error']==0){
        echo '<div class="p-absolute">
        <div class="toast mt-3 bg-primary">
            <div class="toast-header text-success font-weight-bolder">
              <i class="fas fa-check"></i>  Paiement reussi
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
               Erreur de paiement
            </div>
            <div class="toast-body text-light font-weight-bolder">
                veuillez bien remplir les formulaires
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
            <button id="mvolacash" class="BouttonPaiement btn btn-warning text-light hvr-bounce-in">
                Payer via Mvola
            </button>
            </div>
            
            <div>
                <button  id="cash" class="BouttonPaiement btn btn-danger hvr-bounce-in">
                    Versement En Espece &agrave; la banque
                </button>
            </div>';
            }?>
            <div>
                <button id="cheque" class="BouttonPaiement btn btn-primary text-light hvr-bounce-in">
                    Payer Par cheque
                </button>
            </div>
            <div >
                <button id="virement" class="BouttonPaiement btn btn-success hvr-bounce-in">
                    Payer Par Virement Bancaire
                </button> 
            </div>
            <div>
                <button id="western" class="BouttonPaiement btn btn-dark text-warning font-weight-bold hvr-bounce-in">
                    Western Union
                </button> 
            </div>
           
           
        </div>
            
    </div>

    
   
    </section>
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