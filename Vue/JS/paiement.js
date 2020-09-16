$(document).ready(function() {
    (function() {
            $("[name='motif']").change(function(e) {
                /*Mise a jour du panier*/
                $("[name='montant']").val($(this).attr("data-value"));
                $("#Panier").text($("[name='montant']").val());



                /*choix du motif*/
                //on detruit toute moyen du payement si c'est du Certificat

              /*  if ($(this).val() == "certificat") {
                    $(".codepromo").animate({
                        left: "10px",
                        opacity: "0"
                    }, "fast", function() {
                        $(this).remove();
                    })
                }*/
                if ($(this).val() == "ecolage") {
                    var element = '<div id="qe" style="position:relative;opacity:0" class="form-group"><label for="nbm">Nombre de mois à payer</label><input id="nbm" type="number" min="1" max="8" class="form-control"  placeholder="Indiquez le nombre de mois d\'ecolage que vous voulez payez" name="nbecolage" required></div>';
                    $("#motif").after(element);
                    $("#qe").animate({
                        opacity: 1,
                        right: "10px",
                        right: "-10px",


                    }, "fast", function() {
                        $("#qce,#refpromo").remove();
                    });
                    //choix du quantité
                    $("#nbm").change(function() {
                        $("[name='montant']").val(parseInt($("[value='ecolage']").data("value")) * $(this).val());
                        $("#Panier").text($("[name='montant']").val());
                    });
                }else if($(this).val()=="inscription"){
                   
                    

                    $("#qe").animate({
                        left: '10px',
                        opacity: '0',
                    }, "fast", function() {
                        $(this).remove();
                    });
                   
                    if($("#refpromo").length===0){
                        var codepromoelement='<div id="refpromo" class="form-group"> <label for="checkpromo">Activez promo</label> <input type="checkbox" id="checkpromo" name="promotion" value="true" class="form-check-inline"/> <br/> <input type="text" id="codepromo" class="form-control" placeholder="Entrez votre Promo" name="codepromo" disabled="disabled"/><div><strong class="text-danger invalidpromo" style="display:none;">Votre Code promo est invalide</strong><strong class="text-success validpromo" style="display:none;" >Code promo valide</strong></div></div>';
                        var elementparent = $("#formatpaiement").parent();
                        elementparent.after(codepromoelement);

                                // enable form promotion
                        $('#checkpromo').click(function(){
                            if(($('#codepromo').attr("disabled"))=="disabled"){
                                $("#codepromo").removeAttr("disabled"); 
                            
                            }else{
                                $('#codepromo').attr("disabled","disabled");

                            }
                        
                        });
                         //ajax promotion
                        function getCookie(cname) {
                            var name = cname + "=";
                            var decodedCookie = document.cookie;
                            var ca = decodedCookie.split(';');
                            for(var i = 0; i <ca.length; i++) {
                              var c = ca[i];
                              while (c.charAt(0) == ' ') {
                                c = c.substring(1);
                              }
                              if (c.indexOf(name) == 0) {
                                return c.substring(name.length, c.length);
                              }
                            }
                            return "";
                          }

                        $('#codepromo').keyup(function(e) { 
                            
                            if(e.key=="Enter"||e.key=="Control"){
                                e.preventDefault();
                            }else{
                            var codepromovalue=$(this).val();
                          
                            $.post("paiement/Controller/ControlPromotion.php",{ codepromo : codepromovalue,Origin : getCookie("Origin") , Semestre : getCookie("Semestre") , Inscription : getCookie("Inscription") },function(data){
                                if(data==0){
                                    $(".validation").attr("disabled","disabled");
                                    $(".validation").removeAttr("disabled");
                                   $("strong.text-danger.invalidpromo").show();
                                   $("strong.text-success.validpromo").hide();
                                                    
                                }else if(data!=0){
                                    $(".validation").attr("disabled","disabled");
                                    $(".validation").removeAttr("disabled");
                                   $('[name="montant"]').val(data);
                                   $('#Panier').text(data);
                                   $("#codepromo").attr("readonly","readonly");
                                   $("strong.text-danger.invalidpromo").hide();
                                   $("strong.text-success.validpromo").show();
                                }
                            },"text");
                        }
                         });
                    }
                    


                
                   
                    
                }
                /*else if($(this).val()=="CE"){
                            var element = '<div id="qce" class="form-group" style="position:relative;opacity:0"><label for="NBC">Nombre de Certificat</label><input type="number" class="form-control" id="NBC" placeholder="1" name="nbcertificat" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div></div>';
                            $("#motif").after(element);
                           $("#qce").animate({
                               opacity:1,
                               right:"10px",
                               right:"-10px",
                               
                               
                           },"fast",function(){
                               $("#qe").remove();
                           });
                       }*/
                else {
                    $("#qe,#qce,#refpromo").animate({
                        left: '10px',
                        opacity: '0',
                    }, "fast", function() {
                        $(this).remove();
                    });
                }


            });
        })();

        /*choix du quantité*/



        /*choix du solution du paiement selon boutton*/

        $("#mvolacash,#cheque,#cash,#virement,#western,#MoneyGram").click(function() {
            $(".validation").removeAttr("disabled");$(".validation").removeAttr("disabled");
            $(".validation").animate({
                
                opacity: 1,

            }, "fast",function(){
                $(".validation").removeAttr("disabled");
            });
        }, );

        $("#mvolacash").click(function() {


            if ($("#refmvola").attr("data-visibility") !== "true") { //faire en sorte que le meme input ne se repete paset verifier à ce que le payement n'existe pas pour Le certificat

                $("#refbordereaux,#refcheque,.refcompte,#refwestern,#RefMoneyGram").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refbordereaux").remove();
                    $("#refcheque").remove();
                    $("#refwestern").remove();
                    $(".refcompte").remove();
                    $("#RefMoneyGram").remove();
                })

                    var element = '<div id="refmvola" style="position:relative" class="form-group"><div class="form-group"><label for="date">date</label><input type="date" class="form-control" name="date" required id="dateheure"/></div><label for="NBR">Numero de Reference</label><input type="text" class="form-control" id="NBR" placeholder="Exemple : 14589654521357" name="reference" required></div>';
                
             
                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("mvola");
                parent.after(element);
                $("#refmvola").attr("data-visibility", "true");
                //transition lors d'introduction
                $('#refmvola').animate({
                    right: "10px",
                    right: "-10px"
                }, "fast");
            }

        });

        $("#cheque").click(function() {

            if ($("#refcheque").attr("data-visibility") !== "true") {

                $("#refbordereaux,#refmvola,.refcompte,#refwestern,#RefMoneyGram").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refbordereaux").remove();
                    $("#refmvola").remove();
                    $(".refcompte").remove();
                    $("#refwestern").remove();
                    $("#RefMoneyGram").remove();
                });


                var element = '<div id="refcheque" style="position:relative;opacity:1" class="form-group"><label for="etablissement">Etablissement du payeur</label><input type="text" id="etablissement" class="form-control" placeholder="Exemple: BOA" required name="etablissement"/><div class="form-group"><label for="tireur">Tireur</label><input type="text" class="form-control" id="tireur" placeholder="Exemple:Marie Cecile" name="tireur" required/></div><label for="Ncheque">Numero de cheque</label><input type="text" class="form-control" id="Ncheque" placeholder="Exemple: 1120120454 " name="ncheque" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div></div> ';
                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("cheque");
                parent.after(element);
                $("#refcheque").attr("data-visibility", "true");
                $('#refcheque').animate({
                    right: "10px",
                    right: "-10px"
                }, "fast");


            }


        });
        $("#cash").click(function() {
            if ($("#refbordereaux").attr("data-visibility") !== "true") {

                $("#refcheque,#refmvola,.refcompte,#refwestern,#RefMoneyGram").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refcheque").remove();
                    $("#refmvola").remove();
                    $(".refcompte").remove();
                    $("#refwestern").remove();
                    $("#RefMoneyGram").remove();
                });

                var element = '<div id="refbordereaux" style="position:relative;opacity:1" class="form-group"><label for="Nrecu">Numero du bordereaux</label><input type="number" class="form-control" id="Nrecu" placeholder="Exemple: 01234567 " name="nrecu" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div><div class="form-group"><label for="date">date du versement : </label><input type="date" class="form-control" required name="dateversement" id="date"/></div><div class="form-group"><label for="agence" > Agence</label><input placeholder="Exemple: Ambanidia" name="agence" type="text" required class="form-control" id="agence"/></div></div> ';




                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("cash");
                parent.after(element);

                $("#refbordereaux").attr("data-visibility", "true");
                $('#refbordereaux').animate({
                    right: "10px",
                    right: "-10px"
                }, "fast");

            }
        });

        $('.toast').toast({ animation: true, delay: 30000 });
        $('.toast').toast('show');



        $("#virement").click(function() {
            var jour = new Date();

            if ($(".refcompte").attr("data-visibility") !== "true") {

                $("#refcheque,#refmvola,#refbordereaux,#refwestern,#RefMoneyGram").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refcheque").remove();
                    $("#refmvola").remove();
                    $("#refbordereaux").remove();
                    $("#refwestern").remove();
                    $("#RefMoneyGram").remove();
                });


                var element1 = '<div  class="form-group refcompte" style="position:relative;opacity:1"><label for="Ncompte">Votre numero de compte</label><input type="text" class="form-control" id="Ncompte" placeholder="Exemple: 00008 00019 04506001603 39" name="ncompte" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div></div>';

                var element2 = '<div class="form-group refcompte" style="position:relative;opacity:1"><label for="Tcompte">Titulaire du compte</label><input type="text" class="form-control" id="Tcompte" placeholder="Titulaire du compte" name="tcompte" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div></div>';

                var element3 = '<div class="form-group refcompte" style="position:relative;opacity:1"><label for="Datevirement">Date de votre virement</label><input type="text" class="form-control" id="Datevirement" placeholder="exemple: Jours/Mois/Anneé (' + jour.getDate() + '/' + jour.getMonth() + '/' + jour.getFullYear() + ')" name="datevirement" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div></div>'

                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("virement");
                parent.after(element1, element2, element3);
                $(".refcompte").attr("data-visibility", "true");

                $(".refcompte").animate({
                    right: "10px",
                    right: "-10px",
                }, "fast");
            }
        });


        $("#western").click(function() {

            if ($("#refwestern").attr("data-visibility") !== "true") {

                $("#refcheque,#refmvola,#refbordereaux,.refcompte,#RefMoneyGram").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refcheque").remove();
                    $("#refmvola").remove();
                    $("#refbordereaux").remove();
                    $(".refcompte").remove();
                    $("#RefMoneyGram").remove();
                });


                var element = '<div id="refwestern" style="position:relative;opacity:1" class="form-group"><label for="Nsuivi">MTCN(Numero de suivi)</label><input type="text" class="form-control" id="Nsuivi" placeholder="exemple : MTCN:553-314-4635" name="nsuivi" required><div class="valid-feedback">Valide</div><div class="invalid-feedback">Non valide</div><div class="form-group"><label for="Expediteur">Nom de l\'expediteur</label><input type="text" class="form-control" placeholder="Exemple : Jean Dupond" required name="nomexpediteur" id="Expediteur"></div><div class="form-group"><label for="montantwestern" >Somme western </label><input placeholder="0" name="montantwestern" type="text" required class="form-control" id="montantwestern"/></div></div> ';


                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("western");
                parent.after(element);
                $("#refwestern").attr("data-visibility", "true");

                $("#refwestern").animate({
                    right: "10px",
                    right: "-10px",
                }, "fast");

            }

        });
        $('#MoneyGram').click(function(){
            if ($("#RefMoneyGram").attr("data-visibility") !== "true") {

                $("#refcheque,#refmvola,#refbordereaux,.refcompte,#refwestern").animate({
                    left: '10px',
                    opacity: '0'
                        //on met une transition lors de leurs transition
                }, "fast", function() {
                    //on detruit tous les inputs lors du choix du paiement
                    $("#refcheque").remove();
                    $("#refmvola").remove();
                    $("#refbordereaux").remove();
                    $(".refcompte").remove();
                    $("#refwestern").remove();
                });


                var element = '<div id="RefMoneyGram" style="position:relative;opacity:1" class="form-group"><label for="ExpediteurMoney">Nom de l\'expediteur</label><input type="text" class="form-control" id="ExpediteurMoney" placeholder="exemple : Jean Dupon" name="ExpediteurMoney" required><div class="form-group"><label for="RefMoney">Référence :</label><input type="text" class="form-control" placeholder="Exemple : 60708005" required name="RefMoney" id="RefMoney"></div><div class="form-group"><label for="date">date</label><input type="date" class="form-control" name="DateMoney" required id="dateheure"/></div><div class="form-group"><label for="montanMoney" >Montant :</label><input placeholder="0" name="MontantMoney" type="text" required class="form-control" id="montanMoney"/></div></div> ';

                var parent = $("#formatpaiement").parent();
                $("#formatpaiement").val("MoneyGram");
                parent.after(element);
                $("#RefMoneyGram").attr("data-visibility", "true");

                $("#RefMoneyGram").animate({
                    right: "10px",
                    right: "-10px",
                }, "fast");

            }
        });

        // enable form promotion
$('#checkpromo').click(function(){
    if(($('#codepromo').attr("disabled"))=="disabled"){
        $("#codepromo").removeAttr("disabled"); 
       
    }else{
        $('#codepromo').attr("disabled","disabled");

    }
   
});
    }
    

);