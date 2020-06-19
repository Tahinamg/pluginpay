$("document").ready(function(){
    var ajourlistvirement=0;
    var ajourlistcheque=0;
    var ajourlistmvola=0;
    var ajourlistversement=0;
    var ajourlistwestern=0;
            $("#MvolaVoir").click(function(){
                $(".notif,#welcoming").remove();
                clearInterval(ajourlistvirement);
                clearInterval(ajourlistversement);
                clearInterval(ajourlistcheque);
                clearInterval(ajourlistwestern);
                clearInterval(ajourlistmvola);
                var nombretd=0;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=mvola",
                        dataType: "json",
                        success: function (response) {
                            $(".table").empty();
                           $(".table").append(
                            "<thead> <tr> <th>Matricule</th> <th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Reference</th><th>Dateref</th><th>Montant</th><th>IdMobile</th><th>Etat</th><th>Decision</th><th>Dateserver</th> <th>Action</th></tr></thead>"   
                           );
                           $(".table").append(
                               "<tbody></tbody>"
                           );
                           var jsonformat=response;
                            
                         for (var index = 0; index<jsonformat.length; index++) {
                             $("tbody").append(
                                    "<tr><td>"+jsonformat[index]['MATRICULE']+"</td><td>"+jsonformat[index]['NOM']+"</td><td>"+jsonformat[index]['PRENOM']+"</td><td>"+jsonformat[index]['SEMESTRE']+"</td><td>"+jsonformat[index]['MOTIF']+"</td><td>"+jsonformat[index]['REFERENCE']+"</td><td>"+jsonformat[index]['DATY']+"</td><td>"+jsonformat[index]['MONTANT']+"</td><td>"+jsonformat[index]['IDMOBILEMONEY']+"</td><td>"+jsonformat[index]['ETAT']+"</td><td>"+jsonformat[index]['DECISION']+"</td><td>"+jsonformat[index]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+index+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+index+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                    <div class='modal fade' id='myModal"+index+"'>\
                                    <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                    <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                    <div class='modal-body'>\
                                    <form action='../Controller/ControlFinanceValidationMobileMoney.php' method='POST'>\
                                    <input type='hidden' value='"+jsonformat[index]['MOTIF']+"' name='motif' />\
                                    <input type='hidden' value='"+jsonformat[index]['MATRICULE']+"' name='matricule' />\
                                    <input type='hidden' value='"+jsonformat[index]['IDETUDIANTS']+"' name='idetudiants' />\
                                    <input type='hidden' value='"+jsonformat[index]['IDMOBILEMONEY']+"'name='idmobilemoney'/>\
                                    <input type='number' placeholder='0' name='quantite'/>\
                                    <input type='submit' class='btn btn-success' value='validation'/>\
                                    </form>\
                                    </div></div></div></div>\
                                    <div class='modal fade' id='refuModal"+index+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                    <div class='modal-body'>\
                                    <form method='POST' action='../Controller/ControlFinanceRefusMobileMoney.php'>\
                                    <input type='hidden' value='"+jsonformat[index]['IDMOBILEMONEY']+"' name='idmobilemoney'/>\
                                    <input type='submit' value='refuser' class='btn btn-danger'/>\
                                    </form>\
                                    </div></div></div></div></td></tr>"
                             );
                           
                         }
                         nombretd=index;
                        }
                    });





               //MISE A JOUR DU TABLEAU AUTOMATIQUE




               ajourlistmvola=setInterval(function(){

                
                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=mvola",
                    dataType: "JSON",
                   
                    success: function (response) {
                        var jsonformat=response;
                     for (nombretd; nombretd<jsonformat.length; nombretd++) {
                         $("tbody").append(
                                "<tr><td>"+jsonformat[nombretd]['MATRICULE']+"</td><td>"+jsonformat[nombretd]['NOM']+"</td><td>"+jsonformat[nombretd]['PRENOM']+"</td><td>"+jsonformat[nombretd]['SEMESTRE']+"</td><td>"+jsonformat[nombretd]['MOTIF']+"</td><td>"+jsonformat[nombretd]['REFERENCE']+"</td><td>"+jsonformat[nombretd]['DATY']+"</td><td>"+jsonformat[nombretd]['MONTANT']+"</td><td>"+jsonformat[nombretd]['IDMOBILEMONEY']+"</td><td>"+jsonformat[nombretd]['ETAT']+"</td><td>"+jsonformat[nombretd]['DECISION']+"</td><td>"+jsonformat[nombretd]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+nombretd+"'><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+nombretd+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal"+nombretd+"'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationMobileMoney.php' method='POST'>\
                                <input type='hidden' value='"+jsonformat[nombretd]['MOTIF']+"' name='motif' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['MATRICULE']+"' name='matricule' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDETUDIANTS']+"' name='idetudiants' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDMOBILEMONEY']+"'name='idmobilemoney'/>\
                                <input type='number' placeholder='0' name='quantite'/>\
                                <input type='submit' class='btn btn-success' value='validation'/>\
                                </form>\
                                </div></div></div></div>\
                                <div class='modal fade' id='refuModal"+nombretd+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form method='POST' action='../Controller/ControlFinanceRefusMobileMoney.php'>\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDMOBILEMONEY']+"' name='idmobilemoney'/>\
                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                </form>\
                                </div></div></div></div></td></tr>"
                         );
                     }   

                    }
                  
                });
           },3000);
        });


            $("#ChequeVoir").click(function(){
                $(".notif,#welcoming").remove();
                var nombretd=0;
                clearInterval(ajourlistvirement);
                clearInterval(ajourlistversement);
                clearInterval(ajourlistmvola);
                clearInterval(ajourlistwestern);
                clearInterval(ajourlistcheque);
                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=cheque",
                        dataType: "json",
                        success: function (response1) {
                            
                            $(".table").empty();
                            $(".table").append(
                             "<thead> <tr> <th>Matricule</th>  <th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Tireur</th><th>Etablissement</th><th>Montant</th><th>Ncheque</th><th>Etat</th><th>Decision</th><th>Dateserver</th> <th>IdCheque</th><th>Action</th></tr></thead>"   
                            );
                            $(".table").append(
                                "<tbody></tbody>"
                            );
                             var jsonformat=response1;
                          for (var index = 0; index<jsonformat.length; index++) {
                              $("tbody").append(
                                "<tr><td>"+jsonformat[index]['MATRICULE']+"</td><td>"+jsonformat[index]['NOM']+"</td><td>"+jsonformat[index]['PRENOM']+"</td><td>"+jsonformat[index]['SEMESTRE']+"</td><td>"+jsonformat[index]['MOTIF']+"</td><td>"+jsonformat[index]['TIREUR']+"</td><td>"+jsonformat[index]['ETABLISSEMENT']+"</td><td>"+jsonformat[index]['MONTANT']+"</td><td>"+jsonformat[index]['NCHEQUE']+"</td><td>"+jsonformat[index]['ETAT']+"</td><td>"+jsonformat[index]['DECISION']+"</td><td>"+jsonformat[index]['DATESERVER']+"</td><td>"+jsonformat[index]['IDCHEQUE']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+index+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+index+"' ><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal"+index+"'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationCheque.php' method='POST'>\
                                <input type='hidden' value='"+jsonformat[index]['MOTIF']+"' name='motif' />\
                                <input type='hidden' value='"+jsonformat[index]['MATRICULE']+"' name='matricule' />\
                                <input type='hidden' value='"+jsonformat[index]['IDETUDIANTS']+"' name='idetudiants' />\
                                <input type='hidden' value='"+jsonformat[index]['IDCHEQUE']+"'name='idcheque'/>\
                                <input type='number' placeholder='0' name='quantite'/>\
                                <input type='submit' class='btn btn-success' value='validation'/>\
                                </form>\
                                </div></div></div></div>\
                                <div class='modal fade' id='refuModal"+index+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form method='POST' action='../Controller/ControlFinanceRefusCheque.php'>\
                                <input type='hidden' value='"+jsonformat[index]['IDCHEQUE']+"' name='idcheque'/>\
                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                </form>\
                                </div></div></div></div></td></tr>"
                              );
                             
                              
                          }
                          nombretd=index;

                        }
                });  



            ajourlistcheque=setInterval(function(){
                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=cheque",
                    dataType: "json",
                    success: function (response1) {
                        
                         var jsonformat=response1;
                      for (nombretd ; nombretd<jsonformat.length; nombretd++) {
                          $("tbody").append(
                            "<tr><td>"+jsonformat[nombretd]['MATRICULE']+"</td><td>"+jsonformat[nombretd]['NOM']+"</td><td>"+jsonformat[nombretd]['PRENOM']+"</td><td>"+jsonformat[nombretd]['SEMESTRE']+"</td><td>"+jsonformat[nombretd]['MOTIF']+"</td><td>"+jsonformat[nombretd]['TIREUR']+"</td><td>"+jsonformat[nombretd]['ETABLISSEMENT']+"</td><td>"+jsonformat[nombretd]['MONTANT']+"</td><td>"+jsonformat[nombretd]['NCHEQUE']+"</td><td>"+jsonformat[nombretd]['ETAT']+"</td><td>"+jsonformat[nombretd]['DECISION']+"</td><td>"+jsonformat[nombretd]['DATESERVER']+"</td><td>"+jsonformat[nombretd]['IDCHEQUE']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+nombretd+"'><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+nombretd+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                            <div class='modal fade' id='myModal"+nombretd+"'>\
                            <div class='modal-dialog modal-sm'><div class='modal-content'>\
                            <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form action='../Controller/ControlFinanceValidationCheque.php' method='POST'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['MOTIF']+"' name='motif' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['MATRICULE']+"' name='matricule' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDETUDIANTS']+"' name='idetudiants' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDCHEQUE']+"'name='idcheque'/>\
                            <input type='number' placeholder='0' name='quantite'/>\
                            <input type='submit' class='btn btn-success' value='validation'/>\
                            </form>\
                            </div></div></div></div>\
                            <div class='modal fade' id='refuModal"+nombretd+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form method='POST' action='../Controller/ControlFinanceRefusCheque.php'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDCHEQUE']+"' name='idcheque'/>\
                            <input type='submit' value='refuser' class='btn btn-danger'/>\
                            </form>\
                            </div></div></div></div></td></tr>"
                          );
                         
                          
                      }


                    }
            });                
        },3000);


            });
            

            $("#VersementVoir").click(function(){
                $(".notif,#welcoming").remove();
                var nombretd=0;
                clearInterval(ajourlistvirement);
                clearInterval(ajourlistversement);
                clearInterval(ajourlistmvola);
                clearInterval(ajourlistwestern);
                clearInterval(ajourlistcheque);

               
                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=versement",
                        dataType: "json",
                        success: function (response3) {
                                 
                            $(".table").empty();
                            $(".table").append(
                             "<thead> <tr> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Nbordereaux</th><th>Agence</th><th>Montant</th><th>IdVersement</th><th>Etat</th><th>Decision</th><th>DateServer</th><th>Action</th></tr></thead>"   
                            );
                            $(".table").append(
                                "<tbody></tbody>"
                            );
                             var jsonformat=response3;
                          for (var index = 0; index<jsonformat.length; index++) {
                              $("tbody").append(
                                "<tr><td>"+jsonformat[index]['MATRICULE']+"</td><td>"+jsonformat[index]['NOM']+"</td><td>"+jsonformat[index]['PRENOM']+"</td><td>"+jsonformat[index]['SEMESTRE']+"</td><td>"+jsonformat[index]['MOTIF']+"</td><td>"+jsonformat[index]['NBORDEREAUX']+"</td><td>"+jsonformat[index]['AGENCE']+"</td><td>"+jsonformat[index]['MONTANT']+"</td><td>"+jsonformat[index]['IDVERSEMENT']+"</td><td>"+jsonformat[index]['ETAT']+"</td><td>"+jsonformat[index]['DECISION']+"</td><td>"+jsonformat[index]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+index+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+index+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal"+index+"'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationVersement.php' method='POST'>\
                                <input type='hidden' value='"+jsonformat[index]['MOTIF']+"' name='motif' />\
                                <input type='hidden' value='"+jsonformat[index]['MATRICULE']+"' name='matricule' />\
                                <input type='hidden' value='"+jsonformat[index]['IDETUDIANTS']+"' name='idetudiants' />\
                                <input type='hidden' value='"+jsonformat[index]['IDVERSEMENT']+"'name='idversement'/>\
                                <input type='number' placeholder='0' name='quantite'/>\
                                <input type='submit' class='btn btn-success' value='validation'/>\
                                </form>\
                                </div></div></div></div>\
                                <div class='modal fade' id='refuModal"+index+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form method='POST' action='../Controller/ControlFinanceRefusVersement.php'>\
                                <input type='hidden' value='"+jsonformat[index]['IDVERSEMENT']+"' name='idversement'/>\
                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                </form>\
                                </div></div></div></div></td></tr>"
                              );
                             
                              
                          }
                          nombretd=index;
    
                        }
                });

                //ajour list versement


                ajourlistversement= setInterval(function(){
                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=versement",
                        dataType: "json",
                        success: function (response3) {
                                 
                    
                             var jsonformat=response3;
                          for (nombretd; nombretd<jsonformat.length; nombretd++) {
                              $("tbody").append(
                                "<tr><td>"+jsonformat[nombretd]['MATRICULE']+"</td><td>"+jsonformat[nombretd]['NOM']+"</td><td>"+jsonformat[nombretd]['PRENOM']+"</td><td>"+jsonformat[nombretd]['SEMESTRE']+"</td><td>"+jsonformat[nombretd]['MOTIF']+"</td><td>"+jsonformat[nombretd]['NBORDEREAUX']+"</td><td>"+jsonformat[nombretd]['AGENCE']+"</td><td>"+jsonformat[nombretd]['MONTANT']+"</td><td>"+jsonformat[nombretd]['IDVERSEMENT']+"</td><td>"+jsonformat[nombretd]['ETAT']+"</td><td>"+jsonformat[nombretd]['DECISION']+"</td><td>"+jsonformat[nombretd]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+nombretd+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#'data-toggle='modal' data-target='#refuModal"+nombretd+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal"+nombretd+"'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationVersement.php' method='POST'>\
                                <input type='hidden' value='"+jsonformat[nombretd]['MOTIF']+"' name='motif' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['MATRICULE']+"' name='matricule' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDETUDIANTS']+"' name='idetudiants' />\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDVERSEMENT']+"'name='idversement'/>\
                                <input type='number' placeholder='0' name='quantite'/>\
                                <input type='submit' class='btn btn-success' value='validation'/>\
                                </form>\
                                </div></div></div></div>\
                                <div class='modal fade' id='refuModal"+nombretd+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form method='POST' action='../Controller/ControlFinanceRefusVersement.php'>\
                                <input type='hidden' value='"+jsonformat[nombretd]['IDVERSEMENT']+"' name='idversement'/>\
                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                </form>\
                                </div></div></div></div></td></tr>"
                              );
                             
                              
                          }
    
                        }
                });

                },3000);


               });



            $("#VirementVoir").click(function(){
               $(".notif,#welcoming").remove();
                var nombretd=0;
                clearInterval(ajourlistvirement);
                clearInterval(ajourlistversement);
                clearInterval(ajourlistmvola);
                clearInterval(ajourlistcheque);
                clearInterval(ajourlistwestern);
                $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=virement",
                        dataType: "json",
                        success: function (response4) {
                            
                             
                        $(".table").empty();
                        $(".table").append(
                         "<thead> <tr> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>NCompte</th><th>TituCompte</th><th>DateVirement</th><th>Montant</th><th>IdVirement</th><th>Etat</th><th>Decision</th><th>DateServer</th><th>Acion</th></tr></thead>"   
                        );
                        $(".table").append(
                            "<tbody></tbody>"
                        );
                         var jsonformat=response4;
                      for (var index = 0; index<jsonformat.length; index++) {
                          $("tbody").append(
                            "<tr><td>"+jsonformat[index]['MATRICULE']+"</td><td>"+jsonformat[index]['NOM']+"</td><td>"+jsonformat[index]['PRENOM']+"</td><td>"+jsonformat[index]['SEMESTRE']+"</td><td>"+jsonformat[index]['MOTIF']+"</td><td>"+jsonformat[index]['NCOMPTE']+"</td><td>"+jsonformat[index]['TITUCOMPTE']+"</td><td>"+jsonformat[index]['DATEVIREMENT']+"</td><td>"+jsonformat[index]['MONTANT']+"</td><td>"+jsonformat[index]['IDVIREMENT']+"</td><td>"+jsonformat[index]['ETAT']+"</td><td>"+jsonformat[index]['DECISION']+"</td><td>"+jsonformat[index]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+index+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+index+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                            <div class='modal fade' id='myModal"+index+"'>\
                            <div class='modal-dialog modal-sm'><div class='modal-content'>\
                            <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form action='../Controller/ControlFinanceValidationVirement.php' method='POST'>\
                            <input type='hidden' value='"+jsonformat[index]['MOTIF']+"' name='motif' />\
                            <input type='hidden' value='"+jsonformat[index]['MATRICULE']+"' name='matricule' />\
                            <input type='hidden' value='"+jsonformat[index]['IDETUDIANTS']+"' name='idetudiants' />\
                            <input type='hidden' value='"+jsonformat[index]['IDVIREMENT']+"'name='idvirement'/>\
                            <input type='number' placeholder='0' name='quantite'/>\
                            <input type='submit' class='btn btn-success' value='validation'/>\
                            </form>\
                            </div></div></div></div>\
                            <div class='modal fade' id='refuModal"+index+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form method='POST' action='../Controller/ControlFinanceRefusVirement.php'>\
                            <input type='hidden' value='"+jsonformat[index]['IDVIREMENT']+"' name='idvirement'/>\
                            <input type='submit' value='refuser' class='btn btn-danger'/>\
                            </form>\
                            </div></div></div></div></td></tr>"
                          );
                                                   
                      }

                      nombretd=index;
                        }

                });
                


                ajourlistvirement=setInterval(function(){

                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=virement",
                        dataType: "json",
                        success: function (response4) {
                         
                         var jsonformat=response4;
                      for (nombretd; nombretd<jsonformat.length; nombretd++) {
                          $("tbody").append(
                            "<tr><td>"+jsonformat[nombretd]['MATRICULE']+"</td><td>"+jsonformat[nombretd]['NOM']+"</td><td>"+jsonformat[nombretd]['PRENOM']+"</td><td>"+jsonformat[nombretd]['SEMESTRE']+"</td><td>"+jsonformat[nombretd]['MOTIF']+"</td><td>"+jsonformat[nombretd]['NCOMPTE']+"</td><td>"+jsonformat[nombretd]['TITUCOMPTE']+"</td><td>"+jsonformat[nombretd]['DATEVIREMENT']+"</td><td>"+jsonformat[nombretd]['MONTANT']+"</td><td>"+jsonformat[nombretd]['IDVIREMENT']+"</td><td>"+jsonformat[nombretd]['ETAT']+"</td><td>"+jsonformat[nombretd]['DECISION']+"</td><td>"+jsonformat[nombretd]['DATESERVER']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+nombretd+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+nombretd+"' ><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                            <div class='modal fade' id='myModal"+nombretd+"'>\
                            <div class='modal-dialog modal-sm'><div class='modal-content'>\
                            <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form action='../Controller/ControlFinanceValidationVirement.php' method='POST'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['MOTIF']+"' name='motif' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['MATRICULE']+"' name='matricule' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDETUDIANTS']+"' name='idetudiants' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDVIREMENT']+"'name='idvirement'/>\
                            <input type='number' placeholder='0' name='quantite'/>\
                            <input type='submit' class='btn btn-success' value='validation'/>\
                            </form>\
                            </div></div></div></div>\
                            <div class='modal fade' id='refuModal"+nombretd+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form method='POST' action='../Controller/ControlFinanceRefusVirement.php'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDVIREMENT']+"' name='idvirement'/>\
                            <input type='submit' value='refuser' class='btn btn-danger'/>\
                            </form>\
                            </div></div></div></div></td></tr>"
                          );
                                                   
                      }


                        }

                });
                },3000);       




            });






            $("#WesternVoir").click(function(){
                $(".notif,#welcoming").remove();
                clearInterval(ajourlistvirement);
                clearInterval(ajourlistversement);
                clearInterval(ajourlistcheque);
                clearInterval(ajourlistmvola);
                clearInterval(ajourlistwestern);
                var nombretd=0;
                    $.ajax({
                        type: "GET",
                        url: "../Controller/ControlFinanceAffichage.php",
                        data: "notification=western",
                        dataType: "json",
                        success: function (response5) {
                            $(".table").empty();
                           $(".table").append(
                            "<thead> <tr> <th>MTCN</th><th>Expediteur</th><th>MontantWestern</th><th>Devoir</th><th>Motif</th> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>DateServer</th><th>Etat</th><th>Decision</th><th>Action</th></tr></thead>"   
                           );
                           $(".table").append(
                               "<tbody></tbody>"
                           );
                        var jsonformat=response5;
                            
                         for (var index = 0; index<jsonformat.length; index++) {
                             $("tbody").append(
                                    "<tr><td>"+jsonformat[index]['NSUIVI']+"</td><td>"+jsonformat[index]['NOMEXP']+"</td><td>"+jsonformat[index]['MONTANTWESTERN']+"</td><td>"+jsonformat[index]['MONTANT']+"</td><td>"+jsonformat[index]['MOTIF']+"</td><td>"+jsonformat[index]['MATRICULE']+"</td><td>"+jsonformat[index]['NOM']+"</td><td>"+jsonformat[index]['PRENOM']+"</td><td>"+jsonformat[index]['SEMESTRE']+"</td><td>"+jsonformat[index]['DATESERVER']+"</td><td>"+jsonformat[index]['ETAT']+"</td><td>"+jsonformat[index]['DECISION']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+index+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+index+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                    <div class='modal fade' id='myModal"+index+"'>\
                                    <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                    <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                    <div class='modal-body'>\
                                    <form action='../Controller/ControlFinanceValidationWestern.php' method='POST'>\
                                    <input type='hidden' value='"+jsonformat[index]['MOTIF']+"' name='motif' />\
                                    <input type='hidden' value='"+jsonformat[index]['MATRICULE']+"' name='matricule' />\
                                    <input type='hidden' value='"+jsonformat[index]['IDETUDIANTS']+"' name='idetudiants' />\
                                    <input type='hidden' value='"+jsonformat[index]['IDWESTERN']+"'name='idwestern'/>\
                                    <input type='number' placeholder='0' name='quantite'/>\
                                    <input type='submit' class='btn btn-success' value='validation'/>\
                                    </form>\
                                    </div></div></div></div>\
                                    <div class='modal fade' id='refuModal"+index+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                    <div class='modal-body'>\
                                    <form method='POST' action='../Controller/ControlFinanceRefusWestern.php'>\
                                    <input type='hidden' value='"+jsonformat[index]['IDWESTERN']+"' name='idwestern'/>\
                                    <input type='submit' value='refuser' class='btn btn-danger'/>\
                                    </form>\
                                    </div></div></div></div></td></tr>"
                             );
                           
                            
                         }
                         nombretd=index; 
                        }
                    });





               //MISE A JOUR DU TABLEAU AUTOMATIQUE




               ajourlistwestern=setInterval(function(){
                
                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=western",
                    dataType: "json",
                   
                    success: function (response5) {
                        var jsonformat=response5;
                     for (nombretd; nombretd<jsonformat.length; nombretd++) {
                         $("tbody").append(
                            "<tr><td>"+jsonformat[nombretd]['NSUIVI']+"</td><td>"+jsonformat[nombretd]['NOMEXP']+"</td><td>"+jsonformat[nombretd]['MONTANTWESTERN']+"</td><td>"+jsonformat[nombretd]['MONTANT']+"</td><td>"+jsonformat[nombretd]['MOTIF']+"</td><td>"+jsonformat[nombretd]['MATRICULE']+"</td><td>"+jsonformat[nombretd]['NOM']+"</td><td>"+jsonformat[nombretd]['PRENOM']+"</td><td>"+jsonformat[nombretd]['SEMESTRE']+"</td><td>"+jsonformat[nombretd]['DATESERVER']+"</td><td>"+jsonformat[nombretd]['ETAT']+"</td><td>"+jsonformat[nombretd]['DECISION']+"</td><td><a href='#' data-toggle='modal' data-target='#myModal"+nombretd+"' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal"+nombretd+"'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                            <div class='modal fade' id='myModal"+nombretd+"'>\
                            <div class='modal-dialog modal-sm'><div class='modal-content'>\
                            <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form action='../Controller/ControlFinanceValidationWestern.php' method='POST'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['MOTIF']+"' name='motif' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['MATRICULE']+"' name='matricule' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDETUDIANTS']+"' name='idetudiants' />\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDWESTERN']+"'name='idwestern'/>\
                            <input type='number' placeholder='0' name='quantite'/>\
                            <input type='submit' class='btn btn-success' value='validation'/>\
                            </form>\
                            </div></div></div></div>\
                            <div class='modal fade' id='refuModal"+nombretd+"'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                            <div class='modal-body'>\
                            <form method='POST' action='../Controller/ControlFinanceRefusWestern.php'>\
                            <input type='hidden' value='"+jsonformat[nombretd]['IDWESTERN']+"' name='idwestern'/>\
                            <input type='submit' value='refuser' class='btn btn-danger'/>\
                            </form>\
                            </div></div></div></div></td></tr>"
                         );
                         
                     }

                    }
                });
           },3000);
        });






        }

);