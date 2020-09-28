//UPLOAD
$("document").ready(function () {
        var controlitem = $("<form class=\"controleritem mt-3 form-inline\" >\
            <div class=\"form-group\"  align=\"center\">\
            <label class=\"ml-3\">Mois d'entrer :</label>\
            <select name=\"bo\" id=\"bo\" class=\"p-2 ml-1 form-control\">\
            </select>\
            <label class=\"ml-3\">Mois en cours  :</label>\
            <select id=\"month\" name=\"month\" class=\"p-2 ml-1 form-control\">\
            <option value=\"1\">1 mois</option>\
            <option value=\"2\">2 mois</option>\
            <option value=\"3\">3 mois</option>\
            <option value=\"4\">4 mois</option>\
            <option value=\"5\">5 mois</option>\
            <option value=\"6\">6 mois</option>\
            <option value=\"7\">7 mois</option>\
            <option value=\"8\">8 mois</option>\
            </select>\
            <label class=\"ml-3\">Etat de paiement :</label>\
            <select name=\"etat\" id=\"etat\" class=\"p-2 ml-1 form-control\">\
                <option value=\"OUI\">PAYER</option>\
                <option value=\"NON\">NON PAYER</option>\
            </select>\
            <label class=\"ml-3\">Motif  :</label>\
            <select id=\"motif\" name=\"motif\" class=\"p-2 ml-1 form-control\">\
            <option value=\"ecolage\">Ecolage</option>\
            <option value=\"inscription\">Inscription</option>\
            <option value=\"soutenance\">Soutenance</option>\
            <option value=\"examen\">Examen</option>\
            <option value=\"certificat\">Certificat</option>\
            </select>\
            </div></form>");
        var ententerecouvrement = $("<thead><tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>EtatEcolage</th><th>Semestre</th><th>Tel</th><th>Inscription</th><th>Filière</th><th>Vague</th><th>Soutenance</th><th>Examen</th><th>Certificat</th></tr></thead>");


        var ajourlistvirement = 0;
        var ajourlistcheque = 0;
        var ajourlistmvola = 0;
        var ajourlistversement = 0;
        var ajourlistwestern = 0;
        var ajourlistmoneygram = 0;




        //COMMENCEMENT DU RECOUVREMENT ET DU PROMO
        //afficher tous les instructions qu'on peut faire sur le recouvrement
        var ajourpromo = 0;

        $('#recouvrement').click(function () {

            clearInterval(ajourpromo);
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistmoneygram);
            $(".controleritem,.containerpromo").remove();
            $("#welcoming").empty();
            $(".table").empty();
            $(controlitem).insertBefore(".table");
            //alert("hello");
            //prendre toutes les dates et les affiches

            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "recouvrement",
                dataType: "json",
                success: function (data) {
                    var select = data;
                    for (var i = 0; i < select.length; i++) {
                        $("#bo").append("<option value = '" + select[i]['DATEDENTER'] + "'>" + select[i]['DATEDENTER'] + "</option>");
                    }
                    //prendre tous les données du recouvrement et les afficher

                    var ajour = 0;
                    var dateD = document.getElementById("bo").value;
                    var month = $('#month').find('option:selected').val();
                    var etat = $('#etat').find('option:selected').val();
                    var motif = $('#motif').find('option:selected').val();
                    // var dataR = 'inputdate='+ dateD + '&paiementstate='+ etat + '&motif='+ motif + '&mounth='+ month;
                    $.ajax({
                        type: "POST",
                        url: "../Controller/ControlRecouvrement.php",
                        data: {
                            inputdate: dateD,
                            paiementstate: etat,
                            motif: motif,
                            mounth: month
                        },
                        dataType: "json",
                        success: function (dataa) {
                            alert('e');
                            $(".table").empty();
                            $(".table").append(ententerecouvrement);
                            $(".table").append(
                                "<tbody></tbody>"
                            );
                            //alert(dataa);
                            var format = dataa;
                            //alert(format);
                            for (var i = 0; i < format.length; i++) {
                                $("tbody").append(
                                    "<tr><td>" + format[i]['MATRICULE'] + "</td>\
                                <td>" + format[i]['NOM'] + "</td>\
                                <td>" + format[i]['PRENOM'] + "</td>\
                                <td>" + format[i]['ECOLAGE'] + "</td>\
                                <td>" + format[i]['SEMESTRE'] + "</td>\
                                <td>" + format[i]['NUMERO'] + "</td>\
                                <td>" + format[i]['INSCRIPTION'] + "</td>\
                                <td>" + format[i]['FILIERE'] + "</td>\
                                <td>" + format[i]['CODE'] + "</td>\
                                <td>" + format[i]['SOUTENANCE'] + "</td>\
                                <td>" + format[i]['EXAMEN'] + "</td>\
                                <td>" + format[i]['CERTIFICAT'] + "</tr>\
                            ");
                            }
                            ajour = i;
                        }
                    });


                }
            });


        });

        //onglet classification

        $("#classification").click(function () {
            clearInterval(ajourpromo);
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistmoneygram);
            $("#welcoming").empty();
            $(".controleritem,.containerpromo").remove();
            $(".table").empty();
            $("<form class=\"controleritem mt-3 form-inline\" >\
            <div class=\"form-group\"  align=\"center\">\
            <label class=\"ml-3\">Date :</label>\
            <input type=\"date\" id=\"bo\" class=\"p-2 ml-1 form-control\">\
            <label class=\"ml-3\">Motif  :</label>\
            <select id=\"motif\" name=\"motif\" class=\"p-2 ml-1 form-control\">\
            <option value=\"ecolage\">Ecolage</option>\
            <option value=\"inscription\">Inscription</option>\
            <option value=\"soutenance\">Soutenance</option>\
            <option value=\"examen\">Examen</option>\
            <option value=\"certificat\">Certificat</option>\
            </select>\
            <label class=\"ml-3\">Vague :</label>\
            <select id=\"month\" name=\"month\" class=\"p-2 ml-1 form-control\">\
            <option value=\"1\">vague 1</option>\
            <option value=\"2\">vague 2</option>\
            <option value=\"3\">vague 3</option>\
            <option value=\"4\">vague 4</option>\
            </select>\
            <label class=\"ml-3\">Mode de paiement :</label>\
            <select id=\"paiement\" name=\"paiement\" class=\"p-2 ml-1 form-control\">\
            <option value=\"mvola\">Mvola</option>\
            <option value=\"cheque\">Cheque</option>\
            <option value=\"versement\">Versement</option>\
            <option value=\"virement\">Virement</option>\
            <option value=\"western\">Western</option>\
            <option value=\"MoneyGram\">MoneyGram</option>\
            </select>\
    </div></form>").insertBefore(".table");
            $(".table").append(
                "<thead>\
                <tr>\
                    <th>IdWestern</th>\
                    <th>Matricule</th>\
                    <th>Vague</th>\
                    <th>Nom</th>\
                    <th>Prenom</th>\
                    <th>Numero</th>\
                    <th>Nsuivi</th>\
                    <th>NomExpediteur</th>\
                    <th>MontantWestern</th>\
                    <th>Motif</th>\
                    <th>DateEnvoi</th>\
                    <th>Montant</th>\
                    <th>Observation</th>\
                </tr>\
            </thead>\
            </tbody>\
                <tr>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                    <td>test</td>\
                </tr>\
            </tbody>"
            );

        });

        $("#promo").click(function () {

            $("#welcoming").empty();
            $(".table").empty();
            $(".controleritem,.containerpromo").remove();
            $("section").append(
                "<br>\
            <div class=\"container containerpromo\">\
                <div class=\"row\">\
                    <div class=\"col-6 col-sm-6 col-md-6 col-lg-6\">\
                        <select name=\"choix\" id=\"choix\" class=\"col-8 form-control choix\">\
                            <option value=\"OUI\">Utiliser</option>\
                            <option value=\"NON\">Non utiliser</option>\
                        </select>\
                        <br>\
                        <div class=\"ut\">\
                        </div>\
                    </div>\
                    <div class=\"col-6 col-sm-6 col-md-6 col-lg-6\">\
                        <button class=\"btn btn-outline-danger align-items-center col-12 genere\" id=\"genere\">GENENRER UNE CODE PROMO</button>\
                        <img class=\"justify-content-center align-items-center mx-auto d-block img-fluid\" align=\"center\" src=\"../Vue/Image/promo.png\" alt=\"error\">\
                    </div>\
                </div>\
            </div>"
            );

            $('.genere').click(function () {
                $.ajax({
                    type: "POST",
                    dataType: "TEXT",
                    url: "../Controller/ControlPromo.php",
                    data: "create=OUI",
                    success: function (data) {
                        console.log(data);
                    },
                });
            });
            $("select.choix").change(function () {
                clearInterval(ajourpromo);
                var choix = $(this).children("option:selected").val();
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "../Controller/ControlAjaxAffichagePromo.php",
                    data: "utilisation=" + choix,
                    success: function (data) {
                        $(".ut").empty();
                        for (var i = 0; i < data.length; i++) {
                            $(".ut").append(
                                "<div class=\"card border-0 shadow-md shadow-hover w-auto col-8 sup\">\
                                <div class=\"card-body d-flex text-right align-items-center w-auto vue\">\
                                    <button class=\"btn btn-danger text-white te\"><strong>X</strong></button>\
                                    <p id=" + data[i]['codepromo'] + " class=\"mb-0 ml-2 w-auto col-12 im\">" + data[i]['codepromo'] + "</p>\
                                </div>\
                            </div>\
                            <br>");
                        }
                        //suppression code promo dashboard
                        var container = document.querySelectorAll(".card-body");

                        for (let i = 0; i < container.length; i++) {
                            container[i].firstElementChild.addEventListener("click", function () {
                                $.ajax({
                                    type: "POST",
                                    url: "../Controller/ControlPromo.php",
                                    data: {
                                        unset: "OUI",
                                        codepromo: container[i].lastElementChild.id
                                    },
                                    dataType: "text",
                                    success: function (response) {
                                        if (response == "unset success") {
                                            container[i].parentNode.style.transition = "0.01s all 0s ease-in";
                                            container[i].parentNode.style.transform = "translate(0px,-30px)";
                                            setTimeout(function () {
                                                container[i].parentNode.parentNode.removeChild(container[i].parentNode);
                                            }, 20);
                                        }
                                    }
                                });


                            }, false);
                        }

                    },
                });

                ajourpromo = setInterval(function () {
                    $.ajax({
                        type: "POST",
                        dataType: "JSON",
                        url: "../Controller/ControlAjaxAffichagePromo.php",
                        data: "utilisation=" + choix,
                        success: function (data) {
                            $(".ut").empty();
                            for (var i = 0; i < data.length; i++) {
                                $(".ut").append(
                                    "<div class=\"card border-0 shadow-md shadow-hover w-auto col-8 sup\">\
                                    <div class=\"card-body d-flex text-right align-items-center w-auto vue\">\
                                        <button class=\"btn btn-danger text-white te\"><strong>X</strong></button>\
                                        <p id=" + data[i]['codepromo'] + " class=\"mb-0 ml-2 w-auto col-12 im\">" + data[i]['codepromo'] + "</p>\
                                    </div>\
                                </div>\
                                <br>");
                            }
                            //suppression code promo dashboard
                            var container = document.querySelectorAll(".card-body");

                            for (let i = 0; i < container.length; i++) {
                                container[i].firstElementChild.addEventListener("click", function () {
                                    $.ajax({
                                        type: "POST",
                                        url: "../Controller/ControlPromo.php",
                                        data: {
                                            unset: "OUI",
                                            codepromo: container[i].lastElementChild.id
                                        },
                                        dataType: "text",
                                        success: function (response) {
                                            if (response == "unset success") {
                                                container[i].parentNode.style.transition = "0.01s all 0s ease-in";
                                                container[i].parentNode.style.transform = "translate(0px,-30px)";
                                                setTimeout(function () {
                                                    container[i].parentNode.parentNode.removeChild(container[i].parentNode);
                                                }, 20);
                                            }
                                        }
                                    });


                                }, false);
                            }

                        },
                    });
                }, 1000);


            });

        });



        $("#MvolaVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);
            var nombretd = 0;
            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=mvola",
                dataType: "json",
                success: function (response) {
                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>Matricule</th> <th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Reference</th><th>Dateref</th><th>Montant</th><th>IdMobile</th><th>Etat</th><th>Decision</th><th>Dateserver</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th> <th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response;

                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append(
                            "<tr><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['REFERENCE'] + "</td><td>" + jsonformat[index]['DATY'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['IDMOBILEMONEY'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal" + index + "'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationMobileMoney.php' method='POST'>\
                                <div class=\"form-group\">\
                                <label>Observation :</label>\
                                <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                <div class=\"form-group\">\
                                <label>Motif :</label>\
                                <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                <input type='hidden' value='" + jsonformat[index]['IDMOBILEMONEY'] + "'name='idmobilemoney'/>\
                                <input type='number' class=\"form-control\" placeholder='0' name='quantite'/></div>\
                                <input type='submit' class='btn btn-success' value='validation'/>\
                                </form>\
                                </div></div></div></div>\
                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form method='POST' action='../Controller/ControlFinanceRefusMobileMoney.php'>\
                                <input type='hidden' value='" + jsonformat[index]['IDMOBILEMONEY'] + "' name='idmobilemoney'/>\
                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                </form>\
                                </div></div></div></div></td></tr>"
                        );

                    }
                    nombretd = index;
                }
            });





            //MISE A JOUR DU TABLEAU AUTOMATIQUE




            ajourlistmvola = setInterval(function () {


                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=mvola",
                    dataType: "JSON",

                    success: function (response) {
                        var jsonformat = response;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['REFERENCE'] + "</td><td>" + jsonformat[nombretd]['DATY'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['IDMOBILEMONEY'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td>" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "'><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + nombretd + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                        <div class='modal fade' id='myModal" + nombretd + "'>\
                                        <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                        <div class='modal-header'><h5 class='modal-title text-success'>VALIDER?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                        <div class='modal-body'>\
                                        <form action='../Controller/ControlFinanceValidationMobileMoney.php' method='POST'>\
                                        <div class=\"form-group\">\
                                        <label>Observation :</label>\
                                        <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                        <div class=\"form-group\">\
                                        <label>Motif :</label>\
                                        <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                        <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                        <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                        <input type='hidden' value='" + jsonformat[nombretd]['IDMOBILEMONEY'] + "'name='idmobilemoney'/>\
                                        <input type='number' class=\"form-control\" placeholder='0' name='quantite'/></div>\
                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                        </form>\
                                        </div></div></div></div>\
                                        <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                        <div class='modal-body'>\
                                        <form method='POST' action='../Controller/ControlFinanceRefusMobileMoney.php'>\
                                        <input type='hidden' value='" + jsonformat[nombretd]['IDMOBILEMONEY'] + "' name='idmobilemoney'/>\
                                        <input type='submit' value='refuser' class='btn btn-danger'/>\
                                        </form>\
                                        </div></div></div></div></td></tr>"
                            );
                        }

                    }

                });
            }, 3000);
        });


        $("#ChequeVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            var nombretd = 0;
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);
            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=cheque",
                dataType: "json",
                success: function (response1) {

                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>Matricule</th>  <th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Tireur</th><th>Etablissement</th><th>Montant</th><th>Ncheque</th><th>Etat</th><th>Decision</th><th>Dateserver</th> <th>IdCheque</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th><th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response1;
                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append(
                            "<tr><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['TIREUR'] + "</td><td>" + jsonformat[index]['ETABLISSEMENT'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['NCHEQUE'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['IDCHEQUE'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "' ><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                <div class='modal fade' id='myModal" + index + "'>\
                                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                <div class='modal-body'>\
                                                <form action='../Controller/ControlFinanceValidationCheque.php' method='POST'>\
                                                <div class=\"form-group\">\
                                                <label>Observation :</label>\
                                                <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                                <div class=\"form-group\">\
                                                <label>Motif :</label>\
                                                <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                                <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                                <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                <input type='hidden' value='" + jsonformat[index]['IDCHEQUE'] + "'name='idcheque'/>\
                                                <input type='number' class=\"form-control\" placeholder='0' name='quantite'/></div>\
                                                <input type='submit' class='btn btn-success' value='validation'/>\
                                                </form>\
                                                </div></div></div></div>\
                                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                <div class='modal-body'>\
                                                <form method='POST' action='../Controller/ControlFinanceRefusCheque.php'>\
                                                <input type='hidden' value='" + jsonformat[index]['IDCHEQUE'] + "' name='idcheque'/>\
                                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                </form>\
                                                </div></div></div></div></td></tr>"
                        );


                    }
                    nombretd = index;

                }
            });



            ajourlistcheque = setInterval(function () {
                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=cheque",
                    dataType: "json",
                    success: function (response1) {

                        var jsonformat = response1;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['TIREUR'] + "</td><td>" + jsonformat[nombretd]['ETABLISSEMENT'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['NCHEQUE'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td>" + jsonformat[nombretd]['IDCHEQUE'] + "</td><td>" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "'><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + nombretd + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                        <div class='modal fade' id='myModal" + nombretd + "'>\
                                                        <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                        <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                        <div class='modal-body'>\
                                                        <form action='../Controller/ControlFinanceValidationCheque.php' method='POST'>\
                                                        <div class=\"form-group\">\
                                                        <label>Observation :</label>\
                                                        <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                                        <div class=\"form-group\">\
                                                        <label>Motif :</label>\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDCHEQUE'] + "'name='idcheque'/>\
                                                        <input type='number' class=\"form-control\" placeholder='0' name='quantite'/></div>\
                                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                                        </form>\
                                                        </div></div></div></div>\
                                                        <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                        <div class='modal-body'>\
                                                        <form method='POST' action='../Controller/ControlFinanceRefusCheque.php'>\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDCHEQUE'] + "' name='idcheque'/>\
                                                        <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                        </form>\
                                                        </div></div></div></div></td></tr>"
                            );


                        }


                    }
                });
            }, 3000);


        });


        $("#VersementVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            var nombretd = 0;
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);

            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=versement",
                dataType: "json",
                success: function (response3) {

                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>Nbordereaux</th><th>Agence</th><th>Montant</th><th>IdVersement</th><th>Etat</th><th>Decision</th><th>DateServer</th><th>DateDeVersement</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th><th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response3;
                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append(
                            "<tr><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['NBORDEREAUX'] + "</td><td>" + jsonformat[index]['AGENCE'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['IDVERSEMENT'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['DATEVERSEMENT'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                                <div class='modal fade' id='myModal" + index + "'>\
                                                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                                <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                <div class='modal-body'>\
                                                                <form action='../Controller/ControlFinanceValidationVersement.php' method='POST'>\
                                                                <div class=\"form-group\">\
                                                                <label>Observation :</label>\
                                                                <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                                                <div class=\"form-group\">\
                                                                <label>Motif :</label>\
                                                                <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                                                <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                                                <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                                <input type='hidden' value='" + jsonformat[index]['IDVERSEMENT'] + "'name='idversement'/>\
                                                                <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                                <input type='submit' class='btn btn-success' value='validation'/>\
                                                                </form>\
                                                                </div></div></div></div>\
                                                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                <div class='modal-body'>\
                                                                <form method='POST' action='../Controller/ControlFinanceRefusVersement.php'>\
                                                                <input type='hidden' value='" + jsonformat[index]['IDVERSEMENT'] + "' name='idversement'/>\
                                                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                </form>\
                                                                </div></div></div></div></td></tr>"
                        );


                    }
                    nombretd = index;

                }
            });

            //ajour list versement


            ajourlistversement = setInterval(function () {
                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=versement",
                    dataType: "json",
                    success: function (response3) {


                        var jsonformat = response3;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['NBORDEREAUX'] + "</td><td>" + jsonformat[nombretd]['AGENCE'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['IDVERSEMENT'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td></td><td>" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#'data-toggle='modal' data-target='#refuModal" + nombretd + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                                        <div class='modal fade' id='myModal" + nombretd + "'>\
                                                                        <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                                        <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                        <div class='modal-body'>\
                                                                        <form action='../Controller/ControlFinanceValidationVersement.php' method='POST'>\
                                                                        <div class=\"form-group\">\
                                                                        <label>Observation :</label>\
                                                                        <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                                                        <div class=\"form-group\">\
                                                                        <label>Motif :</label>\
                                                                        <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                                                        <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDVERSEMENT'] + "'name='idversement'/>\
                                                                        <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                                                        </form>\
                                                                        </div></div></div></div>\
                                                                        <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                        <div class='modal-body'>\
                                                                        <form method='POST' action='../Controller/ControlFinanceRefusVersement.php'>\
                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDVERSEMENT'] + "' name='idversement'/>\
                                                                        <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                        </form>\
                                                                        </div></div></div></div></td></tr>"
                            );


                        }

                    }
                });

            }, 3000);


        });



        $("#VirementVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            var nombretd = 0;
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);
            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=virement",
                dataType: "json",
                success: function (response4) {


                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>Motif</th><th>NCompte</th><th>TituCompte</th><th>DateVirement</th><th>Montant</th><th>IdVirement</th><th>Etat</th><th>Decision</th><th>DateServer</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th><th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response4;
                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append(
                            "<tr><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['NCOMPTE'] + "</td><td>" + jsonformat[index]['TITUCOMPTE'] + "</td><td>" + jsonformat[index]['DATEVIREMENT'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['IDVIREMENT'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                                                <div class='modal fade' id='myModal" + index + "'>\
                                                                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                                                <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                <div class='modal-body'>\
                                                                                <form action='../Controller/ControlFinanceValidationVirement.php' method='POST'>\
                                                                                <div class=\"form-group\">\
                                                                                <label>Observation :</label>\
                                                                                <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                                                                <div class=\"form-group\">\
                                                                                <label>Motif :</label>\
                                                                                <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                                                                <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                                                                <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                                                <input type='hidden' value='" + jsonformat[index]['IDVIREMENT'] + "'name='idvirement'/>\
                                                                                <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                                                <input type='submit' class='btn btn-success' value='validation'/>\
                                                                                </form>\
                                                                                </div></div></div></div>\
                                                                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                <div class='modal-body'>\
                                                                                <form method='POST' action='../Controller/ControlFinanceRefusVirement.php'>\
                                                                                <input type='hidden' value='" + jsonformat[index]['IDVIREMENT'] + "' name='idvirement'/>\
                                                                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                                </form>\
                                                                                </div></div></div></div></td></tr>"
                        );

                    }

                    nombretd = index;
                }

            });



            ajourlistvirement = setInterval(function () {

                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=virement",
                    dataType: "json",
                    success: function (response4) {

                        var jsonformat = response4;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['NCOMPTE'] + "</td><td>" + jsonformat[nombretd]['TITUCOMPTE'] + "</td><td>" + jsonformat[nombretd]['DATEVIREMENT'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['IDVIREMENT'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td>" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + nombretd + "' ><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                                                        <div class='modal fade' id='myModal" + nombretd + "'>\
                                                                                        <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                                                        <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                        <div class='modal-body'>\
                                                                                        <form action='../Controller/ControlFinanceValidationVirement.php' method='POST'>\
                                                                                        <div class=\"form-group\">\
                                                                                        <label>Observation :</label>\
                                                                                        <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                                                                        <div class=\"form-group\">\
                                                                                        <label>Motif :</label>\
                                                                                        <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                                                                        <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDVIREMENT'] + "'name='idvirement'/>\
                                                                                        <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                                                                        </form>\
                                                                                        </div></div></div></div>\
                                                                                        <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                        <div class='modal-body'>\
                                                                                        <form method='POST' action='../Controller/ControlFinanceRefusVirement.php'>\
                                                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDVIREMENT'] + "' name='idvirement'/>\
                                                                                        <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                                        </form>\
                                                                                        </div></div></div></div></td></tr>"
                            );

                        }


                    }

                });
            }, 3000);




        });






        $("#WesternVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);
            var nombretd = 0;
            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=western",
                dataType: "json",
                success: function (response5) {
                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>MTCN</th><th>Expediteur</th><th>MontantWestern</th><th>Devoir</th><th>Motif</th> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>Semestre</th><th>DateServer</th><th>Etat</th><th>Decision</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th><th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response5;

                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append(
                            "<tr><td>" + jsonformat[index]['NSUIVI'] + "</td><td>" + jsonformat[index]['NOMEXP'] + "</td><td>" + jsonformat[index]['MONTANTWESTERN'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                                                                <div class='modal fade' id='myModal" + index + "'>\
                                                                                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                                                                <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                                <div class='modal-body'>\
                                                                                                <form action='../Controller/ControlFinanceValidationWestern.php' method='POST'>\
                                                                                                <div class=\"form-group\">\
                                                                                                <label>Observation :</label>\
                                                                                                <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                                                                                <div class=\"form-group\">\
                                                                                                <label>Motif :</label>\
                                                                                                <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                                                                                <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                                                                                <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                                                                <input type='hidden' value='" + jsonformat[index]['IDWESTERN'] + "'name='idwestern'/>\
                                                                                                <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                                                                <input type='submit' class='btn btn-success' value='validation'/>\
                                                                                                </form>\
                                                                                                </div></div></div></div>\
                                                                                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                                                <div class='modal-body'>\
                                                                                                <form method='POST' action='../Controller/ControlFinanceRefusWestern.php'>\
                                                                                                <input type='hidden' value='" + jsonformat[index]['IDWESTERN'] + "' name='idwestern'/>\
                                                                                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                                                </form>\
                                                                                                </div></div></div></div></td></tr>"
                        );


                    }
                    nombretd = index;
                }
            });





            //MISE A JOUR DU TABLEAU AUTOMATIQUE




            ajourlistwestern = setInterval(function () {

                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=western",
                    dataType: "json",

                    success: function (response5) {
                        var jsonformat = response5;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['NSUIVI'] + "</td><td>" + jsonformat[nombretd]['NOMEXP'] + "</td><td>" + jsonformat[nombretd]['MONTANTWESTERN'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>+" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + nombretd + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                <div class='modal fade' id='myModal" + nombretd + "'>\
                                <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                <div class='modal-header'><h4 class='modal-title text-success'>VALIDER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                <div class='modal-body'>\
                                <form action='../Controller/ControlFinanceValidationWestern.php' method='POST'>\
                                       <div class=\"form-group\">\
                                           <label>Observation :</label>\
                                            <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                           <div class=\"form-group\">\
                                                <label>Motif :</label>\
                                                   <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                                       <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDWESTERN'] + "'name='idwestern'/>\
                                                        <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                                           </form>\
                                                        </div></div></div></div>\
                                                         <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                         <div class='modal-body'>\
                                                         <form method='POST' action='../Controller/ControlFinanceRefusWestern.php'>\
                                                        <input type='hidden' value='" + jsonformat[nombretd]['IDWESTERN'] + "' name='idwestern'/>\
                                                        <input type='submit' value='refuser' class='btn btn-danger'/>\
                                            </form>\
                                        </div></div></div></div></td></tr>"
                            );

                        }

                    }
                });
            }, 3000);
        });

        //MoneyGram
        $("#MoneyGram").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo").remove();
            var nombretd = 0;
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmoneygram);
            clearInterval(ajourpromo);
            $.ajax({
                type: "GET",
                url: "../Controller/ControlFinanceAffichage.php",
                data: "notification=MoneyGram",
                dataType: "json",
                success: function (response6) {


                    $(".table").empty();
                    $(".table").append(
                        "<thead> <tr> <th>Matricule</th><th>Nom</th><th>Prenom</th><th>IdEtudiant</th><th>Semestre</th><th>IdMoneyGram</th><th>DateMoneyGram</th><th>Reference</th><th>Expediteur</th><th>DateServer</th><th>Motif</th><th>Decision</th><th>Etat</th><th>Montant</th><th>MontantMoneyGram</th><th>Observation</th><th>Datevalidation</th><th>Tempsvalidation</th><th>Action</th></tr></thead>"
                    );
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    var jsonformat = response6;
                    for (var index = 0; index < jsonformat.length; index++) {
                        $("tbody").append("<tr><td>" + jsonformat[index]['MATRICULE'] + "</td><td>" + jsonformat[index]['NOM'] + "</td><td>" + jsonformat[index]['PRENOM'] + "</td><td>" + jsonformat[index]['IDETUDIANTS'] + "</td><td>" + jsonformat[index]['SEMESTRE'] + "</td><td>" + jsonformat[index]['IDMONEYGRAM'] + "</td><td>" + jsonformat[index]['DATYMONEYGRAM'] + "</td><td>" + jsonformat[index]['REFERENCE'] + "</td><td>" + jsonformat[index]['EXPEDITEUR'] + "</td><td>" + jsonformat[index]['DATESERVER'] + "</td><td>" + jsonformat[index]['MOTIF'] + "</td><td>" + jsonformat[index]['DECISION'] + "</td><td>" + jsonformat[index]['ETAT'] + "</td><td>" + jsonformat[index]['MONTANT'] + "</td><td>" + jsonformat[index]['MONTANTMONEYGRAM'] + "</td><td>" + jsonformat[index]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + index + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + index + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                        <div class='modal fade' id='myModal" + index + "'>\
                                        <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                        <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                        <div class='modal-body'>\
                                        <form action='../Controller/ControlFinanceValidationMoneyGram.php' method='POST'>\
                                            <div class=\"form-group\">\
                                                <label>Observation :</label>\
                                                        <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[index]['OBSERVATION'] + "' value=\"" + jsonformat[index]['OBSERVATION'] + "\"></textarea></div>\
                                                        <div class=\"form-group\">\
                                                        <label>Motif :</label>\
                                                        <input type='hidden' value='" + jsonformat[index]['MOTIF'] + "' name='motif' />\
                                                        <input type='hidden' value='" + jsonformat[index]['MATRICULE'] + "' name='matricule' />\
                                                        <input type='hidden' value='" + jsonformat[index]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                        <input type='hidden' value='" + jsonformat[index]['IDMONEYGRAM'] + "'name='idmoneygram'/>\
                                                        <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                        <input type='submit' class='btn btn-success' value='validation'/>\
                                                        </form>\
                                                            </div></div></div></div>\
                                                                <div class='modal fade' id='refuModal" + index + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                                    <div class='modal-body'>\
                                                                        <form method='POST' action='../Controller/ControlFinanceRefusMoneyGram.php'>\
                                                                            <input type='hidden' value='" + jsonformat[index]['IDMONEYGRAM'] + "' name='idmoneygram'/>\
                                                                                <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                        </form>\
                                                                    </div></div></div></div></td></tr>");

                    }

                    nombretd = index;
                }

            });


            ajourlistmoneygram = setInterval(function () {

                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "notification=MoneyGram",
                    dataType: "json",
                    success: function (response6) {

                        var jsonformat = response6;
                        for (nombretd; nombretd < jsonformat.length; nombretd++) {
                            $("tbody").append(
                                "<tr><td>" + jsonformat[nombretd]['MATRICULE'] + "</td><td>" + jsonformat[nombretd]['NOM'] + "</td><td>" + jsonformat[nombretd]['PRENOM'] + "</td><td>" + jsonformat[nombretd]['IDETUDIANTS'] + "</td><td>" + jsonformat[nombretd]['SEMESTRE'] + "</td><td>" + jsonformat[nombretd]['IDMONEYGRAM'] + "</td><td>" + jsonformat[nombretd]['DATYMONEYGRAM'] + "</td><td>" + jsonformat[nombretd]['REFERENCE'] + "</td><td>" + jsonformat[nombretd]['EXPEDITEUR'] + "</td><td>" + jsonformat[nombretd]['DATESERVER'] + "</td><td>" + jsonformat[nombretd]['MOTIF'] + "</td><td>" + jsonformat[nombretd]['DECISION'] + "</td><td>" + jsonformat[nombretd]['ETAT'] + "</td><td>" + jsonformat[nombretd]['MONTANT'] + "</td><td>" + jsonformat[nombretd]['MONTANTMONEYGRAM'] + "</td><td>" + jsonformat[nombretd]['OBSERVATION'] + "</td><td>" + jsonformat[index]['DATEVALIDATION'] + "</td><td>" + jsonformat[index]['TEMPSVALIDATION'] + "</td><td><a href='#' data-toggle='modal' data-target='#myModal" + nombretd + "' ><i class='mx-1 fas fa-check text-success'></i></a> <a href='#' data-toggle='modal' data-target='#refuModal" + nombretd + "'><i class='mx-1 fas fa-window-close text-danger'></i></a>\
                                                            <div class='modal fade' id='myModal" + nombretd + "'>\
                                                            <div class='modal-dialog modal-sm'><div class='modal-content'>\
                                                            <div class='modal-header'><h5 class='modal-title text-success'>Êtes-vous sur de valider?</h5><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                            <div class='modal-body'>\
                                                            <form action='../Controller/ControlFinanceValidationMoneyGram.php' method='POST'>\
                                                            <div class=\"form-group\">\
                                                            <label>Observation :</label>\
                                                            <textarea class=\"form-control\" name=\"observation\" cols=\"25\" rows=\"3\" placeholder='" + jsonformat[nombretd]['OBSERVATION'] + "' value=\"" + jsonformat[nombretd]['OBSERVATION'] + "\"></textarea></div>\
                                                            <div class=\"form-group\">\
                                                            <label>Motif :</label>\
                                                            <input type='hidden' value='" + jsonformat[nombretd]['MOTIF'] + "' name='motif' />\
                                                            <input type='hidden' value='" + jsonformat[nombretd]['MATRICULE'] + "' name='matricule' />\
                                                            <input type='hidden' value='" + jsonformat[nombretd]['IDETUDIANTS'] + "' name='idetudiants' />\
                                                            <input type='hidden' value='" + jsonformat[nombretd]['IDMONEYGRAM'] + "'name='idmoneygram'/>\
                                                            <input class=\"form-control\" type='number' placeholder='0' name='quantite'/></div>\
                                                            <input type='submit' class='btn btn-success' value='validation'/>\
                                                            </form>\
                                                            </div></div></div></div>\
                                                            <div class='modal fade' id='refuModal" + nombretd + "'><div class='modal-dialog modal-sm'><div class='modal-content'><div class='modal-header'><h4 class='modal-title text-danger'>REFUSER?</h4><button type='button' class='close' data-dismiss='modal'>×</button></div>\
                                                            <div class='modal-body'>\
                                                            <form method='POST' action='../Controller/ControlFinanceRefusMoneyGram.php'>\
                                                            <input type='hidden' value='" + jsonformat[nombretd]['IDMONEYGRAM'] + "' name='idmoneygram'/>\
                                                            <input type='submit' value='refuser' class='btn btn-danger'/>\
                                                                </form>\
                                                                    </div></div></div></div></td></tr>"
                            );

                        }


                    }

                });
            }, 3000);




        });
        //MoneyGram





    }

);