$("document").ready(function () {
    //to save data
    function s2ab(s) {
  
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
        
    }


        var controlitem = "<div class='controlrecouvrement'>\
            <form class=\"mt-3 form-inline\">\
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
            <div class='form-group' >\
            <button id='findrecouvrement' class='btn btn-secondary'> Rechercher</button>\
            </div>\
            <div class='form-group m-3' >\
            <button id='tranlatesheetrecouvrement' class='btn btn-success'>Exporter en xls</button>\
            </div>\
            </div>`\
            </form>\
            <br/><br/><br/>\
            <div>\
            <h4>Filtrer selon matricule voulu</h4>\
            <input type='text' id='recouvrementsearch' class='form-control' placeholder='rechercher'/>\
            </div></div>";
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

        $('#recouvrement').click(function (e) {
            e.preventDefault();
            clearInterval(ajourpromo);
            clearInterval(ajourlistvirement);
            clearInterval(ajourlistversement);
            clearInterval(ajourlistcheque);
            clearInterval(ajourlistwestern);
            clearInterval(ajourlistmvola);
            clearInterval(ajourlistmoneygram);
            $(".controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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

                    
                    // var dataR = 'inputdate='+ dateD + '&paiementstate='+ etat + '&motif='+ motif + '&mounth='+ month;

                   
            $("#findrecouvrement").click(function(e){
                var ajour = 0;
                var dateD = $("#bo").val();
                var month = $('#month').find('option:selected').val();
                var etat = $('#etat').find('option:selected').val();
                var motif = $('#motif').find('option:selected').val();
                e.preventDefault();
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
                            $("#recouvrementsearch").keyup(function(){
                                var value = $(this).val().toLowerCase();
                                $(".table tr").filter(function() {
                                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                            })
                            
                        }
                    });

                    $("#tranlatesheetrecouvrement").click(function(e){
                        e.preventDefault();
                        var wb = XLSX.utils.book_new();
                        wb.Props = {
                            Title: "RECOUVREMENT",
                            Subject: "RECOUVREMENT DES ETUDIANTS",
                            Author: "RAVELOJAONA TAHINA",
                            CreatedDate: new Date()
                        };
                        wb.SheetNames.push("Recouvrement");
                        var ws = XLSX.utils.table_to_sheet(document.getElementsByClassName("table")[0]);
                        wb.Sheets["Recouvrement"] = ws;
                        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
                        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'Recouvrement.xlsx');

                    });
                
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

            //mettre en place HTML du classsification
            $("#welcoming").empty();
            $(".controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
            $(".table").empty();
            $("<div class='controleritem'>\
            <h3 class='text-center' >Classifiez les paiements selon ces options</h3>\
            <p>Recherchez tous les paiements que vous avez valider selon une date précise </p>\
            <form class=\"mt-3 form-inline\" >\
            <div class=\"form-group\"  align=\"center\">\
            <label class=\"ml-3\">Date de validation :</label>\
            <input type=\"date\" id=\"datevalidation\" class=\"p-2 ml-1 form-control\">\
            <label class=\"ml-3\">Motif  du paiement:</label>\
            <select id=\"motifdepaiement\" name=\"motif\" class=\"p-2 ml-1 form-control\">\
            <option selected value=''>Choisir un motif</option>\
            <option value=\"ecolage\">Ecolage</option>\
            <option value=\"inscription\">Inscription</option>\
            <option value=\"Droit de soutenance\">Droit de soutenance</option>\
            <option value=\"droit examen semestriel\">Droit examen semestriel</option>\
            <option value=\"certificat\">certificat</option>\
            <option value='repechage'>Repechage</option>\
            </select>\
            <label class=\"ml-3\">Mode de paiement :</label>\
            <select id=\"modepaiement\" name=\"modepaiement\" class=\"p-2 ml-1 form-control\">\
            <option value=\"mvola\">Mvola</option>\
            <option value=\"cheque\">Cheque</option>\
            <option value=\"versement\">Versement</option>\
            <option value=\"virement\">Virement</option>\
            <option value=\"western\">Western</option>\
            <option value=\"MoneyGram\">MoneyGram</option>\
            </select>\
            <div class='form-group'>\
            <label>&nbsp; &nbsp; Dans quelle nationalite</label>\
            <select class='form-control' id='nationalite' name='classification'>\
                <option selected value=''>--nationalite--</option>\
                <option value='MG' >MALAGASY</option>\
                <option  value='ET' >ETRANGER</option>\
            <select>\
            <div>\
            <div class='form-group m-3'>\
            <input type='button' id='searchclassification' class='btn btn-secondary' value='Rechercher'/>\
            </div>\
            <div class='form-group m-3'>\
            <input type='button' id='exportclassificationtosheet' class='btn btn-success' value='exporter xlxs'/>\
            </div>\
            </div></form></div>").insertBefore(".table");

            $("<div class='controlpaiementavalable'>\
            <form>\
            <div class='form-group'>\
                <h3>Listez tous les paiements que vous avez valider selon votre choix</h3>\
                <label>Mode de paiement</label>\
                <select class='form-control' id='listpaiementavalable'>\
                    <option value='mvola'>Mvola</option>\
                    <option value='cheque'>Cheque</option>\
                    <option value='moneygram'> Moneygram</option>\
                    <option value='virement'>Virement</option>\
                    <option value='versement'>Versement</option>\
                    <option value='western'>Western</option>\
                </select>\
            </div>\
            <div class='form-group'>\
            <input id='searchallpaiement' class='btn btn-secondary' value='Rechercher'/>\
            </div><br/>\
            <div class='form-group'>\
            <input id='exportallpaiementtosheet' class='btn btn-success' value='exporter en xlxs'/>\
            </div><br/>\
            <input type='text' id='searchfromallpaiement' class='form-control' placeholder='rechercher une paiement specifique'/>\
            </form></div>").insertBefore(".table");

            //ON CLICK ET ON FAIT APERCEVOIR LA LISTE DU PAIEMENT SELON LE MODE DE PAIEMENT
            
            $("#searchallpaiement").click(function(){
                $(".notification").remove();
                $(".table").empty();
                $.post("../Controller/ControlClassification.php", {classification:"allpaiement",modepaiement:$("#listpaiementavalable").val()},
                    function (jsonresponse, textStatus, jqXHR) {
                        if($("#listpaiementavalable").val()=='mvola'){
                            $(".table").append("\
                            <thead>\
                                <tr>\
                                    <th>MATRICULE</th>\
                                    <th>NOM</th>\
                                    <th>PRENOM</th>\
                                    <th>MAIL</th>\
                                    <th>NUMERO</th>\
                                    <th>DATE D'INSERTION</th>\
                                    <th>DATE AU GUICHET</th>\
                                    <th>MONTANT</th>\
                                    <th>REFERENCE</th>\
                                    <th>OBSERVATION</th>\
                                    <th>DATEVALIDATION</th>\
                                    <th>TEMPSVALIDATION</th>\
                                    <th>MOTIF</th>\
                                </tr>\
                            </thead>\
                            <tbody>\
                            </tbody>\
                            ");
                            for(var i=0;i < jsonresponse.length;i++){                          
                                $("tbody").append("\
                                <tr>\
                                <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                <td>"+jsonresponse[i]["NOM"]+"</td>\
                                <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                <td>"+jsonresponse[i]["DATY"]+"</td>\
                                <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                <td>"+jsonresponse[i]["REFERENCE"]+"</td>\
                                <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                </tr>");
                            }
                        }else if($("#listpaiementavalable").val()=='cheque'){
                            $(".table").append(
                                "<thead>\
                                    <tr>\
                                        <th>MATRICULE</th>\
                                        <th>NOM</th>\
                                        <th>PRENOM</th>\
                                        <th>MAIL</th>\
                                        <th>NUMERO</th>\
                                        <th>DATE D'INSERTION</th>\
                                        <th>MONTANT</th>\
                                        <th>TIREUR</th>\
                                        <th>ETABLISSEMENT</th>\
                                        <th>NUMERO DU CHEQUE</th>\
                                        <th>OBSERVATION</th>\
                                        <th>DATEVALIDATION</th>\
                                        <th>TEMPSVALIDATION</th>\
                                        <th>MOTIF</th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>");
                                for(var i=0;i < jsonresponse.length;i++){                          
                                    $("tbody").append("\
                                    <tr>\
                                    <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                    <td>"+jsonresponse[i]["NOM"]+"</td>\
                                    <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                    <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                    <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                    <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                    <td>"+jsonresponse[i]["TIREUR"]+"</td>\
                                    <td>"+jsonresponse[i]["ETABLISSEMENT"]+"</td>\
                                    <td>"+jsonresponse[i]["NCHEQUE"]+"</td>\
                                    <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                    </tr>");
                                }
                        }else if($('#listpaiementavalable').val()=='moneygram'){
                            $(".table").append(
                                "<thead>\
                                    <tr>\
                                        <th>MATRICULE</th>\
                                        <th>NOM</th>\
                                        <th>PRENOM</th>\
                                        <th>MAIL</th>\
                                        <th>NUMERO</th>\
                                        <th>DATE D'INSERTION</th>\
                                        <th>DATE D'ENVOIE</th>\
                                        <th>REFERENCE</th>\
                                        <th>MONTANT ENVOYER</th>\
                                        <th>MONTANT A DEVOIR</th>\
                                        <th>NOM DE L'EXPEDITEUR</th>\
                                        <th>OBSERVATION</th>\
                                        <th>DATEVALIDATION</th>\
                                        <th>TEMPSVALIDATION</th>\
                                        <th>MOTIF</th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>");
                                for(var i=0;i < jsonresponse.length;i++){                          
                                    $("tbody").append("\
                                    <tr>\
                                    <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                    <td>"+jsonresponse[i]["NOM"]+"</td>\
                                    <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                    <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                    <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                    <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                    <td>"+jsonresponse[i]["DATYMONEYGRAM"]+"</td>\
                                    <td>"+jsonresponse[i]["REFERENCE"]+"</td>\
                                    <td>"+jsonresponse[i]["EXPEDITEUR"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANTMONEYGRAM"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                    <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                    </tr>");
                                }
                        }else if($('#listpaiementavalable').val()=='virement'){
                            $(".table").append(
                                "<thead>\
                                    <tr>\
                                        <th>MATRICULE</th>\
                                        <th>NOM</th>\
                                        <th>PRENOM</th>\
                                        <th>MAIL</th>\
                                        <th>NUMERO</th>\
                                        <th>DATE D'INSERTION</th>\
                                        <th>DATE DU VIREMENT</th>\
                                        <th>NUMERO DU COMPTE</th>\
                                        <th>TITULAIRE DU COMPTE</th>\
                                        <th>MONTANT</th>\
                                        <th>OBSERVATION</th>\
                                        <th>DATEVALIDATION</th>\
                                        <th>TEMPSVALIDATION</th>\
                                        <th>MOTIF</th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>");
                                for(var i=0;i < jsonresponse.length;i++){                          
                                    $("tbody").append("\
                                    <tr>\
                                    <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                    <td>"+jsonresponse[i]["NOM"]+"</td>\
                                    <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                    <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                    <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                    <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVIREMENT"]+"</td>\
                                    <td>"+jsonresponse[i]["NCOMPTE"]+"</td>\
                                    <td>"+jsonresponse[i]["TITUCOMPTE"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                    <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                    </tr>");
                                }
                        }else if($('#listpaiementavalable').val()=='versement'){
                            $(".table").append(
                                "<thead>\
                                    <tr>\
                                        <th>MATRICULE</th>\
                                        <th>NOM</th>\
                                        <th>PRENOM</th>\
                                        <th>MAIL</th>\
                                        <th>NUMERO</th>\
                                        <th>DATE D'INSERTION</th>\
                                        <th>DATE DU VERSEMENT</th>\
                                        <th>AGENCE DU VERSEMENT</th>\
                                        <th>NUMERO DU BORDEREAUX</th>\
                                        <th>MONTANT</th>\
                                        <th>OBSERVATION</th>\
                                        <th>DATEVALIDATION</th>\
                                        <th>TEMPSVALIDATION</th>\
                                        <th>MOTIF</th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>");
                                for(var i=0;i < jsonresponse.length;i++){                          
                                    $("tbody").append("\
                                    <tr>\
                                    <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                    <td>"+jsonresponse[i]["NOM"]+"</td>\
                                    <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                    <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                    <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                    <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVERSEMENT"]+"</td>\
                                    <td>"+jsonresponse[i]["AGENCE"]+"</td>\
                                    <td>"+jsonresponse[i]["NBORDEREAUX"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                    <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                    </tr>");
                                }
                        }else if($("#listpaiementavalable").val()=='western'){
                            $(".table").append(
                                "<thead>\
                                    <tr>\
                                        <th>MATRICULE</th>\
                                        <th>NOM</th>\
                                        <th>PRENOM</th>\
                                        <th>MAIL</th>\
                                        <th>NUMERO</th>\
                                        <th>DATE D'INSERTION</th>\
                                        <th>MONTANT ENVOYÉ</th>\
                                        <th>MONTANT A DEVOIR</th>\
                                        <th>NUMERO DE SUIVI</th>\
                                        <th>NOM DE L'EXPEDITEUR</th>\
                                        <th>OBSERVATION</th>\
                                        <th>DATEVALIDATION</th>\
                                        <th>TEMPSVALIDATION</th>\
                                        <th>MOTIF</th>\
                                    </tr>\
                                </thead>\
                                <tbody>\
                                </tbody>");
                                for(var i=0;i < jsonresponse.length;i++){                          
                                    $("tbody").append("\
                                    <tr>\
                                    <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                    <td>"+jsonresponse[i]["NOM"]+"</td>\
                                    <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                    <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                    <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                    <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                    <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANTWESTERN"]+"</td>\
                                    <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                    <td>"+jsonresponse[i]["NSUIVI"]+"</td>\
                                    <td>"+jsonresponse[i]["NOMEXP"]+"</td>\
                                    <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                    <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                    <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                    </tr>");
                                }
                        }
                    },
                    "JSON"
                );
                    //FILTRAGE DU TABLE ALLPAIEMENT
                $("#searchfromallpaiement").keyup(function(){
                    var value = $(this).val().toLowerCase();
                    $(".table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                });

                $("#exportallpaiementtosheet").click(function (e) {
                    e.preventDefault();
                        e.preventDefault();
                        var wb = XLSX.utils.book_new();
                        wb.Props = {
                            Title: "LIST PAIEMENT",
                            Subject: "LIST PAIEMENT DES ETUDIANTS",
                            Author: "RAVELOJAONA TAHINA",
                            CreatedDate: new Date()
                        };
                        wb.SheetNames.push("allpaiement");
                        var ws = XLSX.utils.table_to_sheet(document.getElementsByClassName("table")[0]);
                        wb.Sheets["allpaiement"] = ws;
                        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
                        var name=$("#listpaiementavalable").val()+"paiement.xlsx"
                        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}),name);

                   

                  });

            });
            
            //CHERCHE LES PAIEMENTS EFFECTUER DURANT UNE DATE DE VALIDATION SPECIFIQUE

            $("#searchclassification").click(function(){
                $(".notification").remove();
                $(".table").empty();
                //ON ENVOIE LE MODE DE PAIEMENT,LA DATE DE VALIDATION,LA MOTIF,ET LA NATIONALITE AU FICHIER PHP
                $.post("../Controller/ControlClassification.php",{classification:$("#modepaiement").val(), datevalidation : $("#datevalidation").val(),
                motif : $("#motifdepaiement").val(),nationalite:$("#nationalite").val()},
                    function (jsonresponse, textStatus, jqXHR) {
                    
                        switch ($("#modepaiement").val()) {
                            case "mvola":
                            if(jsonresponse.length==0){
                                    $("#containertable").append("<h2 class='notification text-center text-primary' >Aucun resultat de votre recherche</h2>");
                                    //ON MODIFIE L'ENTETE DU CHAQUE TABLE SELON LA MODE DU PAIEMENT
                            }else{
                                $(".table").append(
                                    "<thead>\
                                        <tr>\
                                            <th>MATRICULE</th>\
                                            <th>NOM</th>\
                                            <th>PRENOM</th>\
                                            <th>NATIONALITE</th>\
                                            <th>MAIL</th>\
                                            <th>NUMERO</th>\
                                            <th>DATE D'INSERTION</th>\
                                            <th>DATE AU GUICHET</th>\
                                            <th>MONTANT</th>\
                                            <th>REFERENCE</th>\
                                            <th>OBSERVATION</th>\
                                            <th>DATEVALIDATION</th>\
                                            <th>TEMPSVALIDATION</th>\
                                            <th>MOTIF</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                    </tbody>");

                                    for(var i=0;i < jsonresponse.length;i++){                          
                                        $("tbody").append("\
                                        <tr>\
                                        <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                        <td>"+jsonresponse[i]["NOM"]+"</td>\
                                        <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                        <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                        <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                        <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                        <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                        <td>"+jsonresponse[i]["DATY"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                        <td>"+jsonresponse[i]["REFERENCE"]+"</td>\
                                        <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                        </tr>");
                                    }
                                }
                                break;
                        
                            case "cheque":
                                if(jsonresponse.length==0){
                                    $("#containertable").append("<h2 class='notification' >Aucun resultat de votre recherche</h2>");
                            }else{
                                $(".table").append(
                                    "<thead>\
                                        <tr>\
                                            <th>MATRICULE</th>\
                                            <th>NOM</th>\
                                            <th>PRENOM</th>\
                                            <th>NATIONALITE</th>\
                                            <th>MAIL</th>\
                                            <th>NUMERO</th>\
                                            <th>DATE D'INSERTION</th>\
                                            <th>MONTANT</th>\
                                            <th>TIREUR</th>\
                                            <th>ETABLISSEMENT</th>\
                                            <th>NUMERO DU CHEQUE</th>\
                                            <th>OBSERVATION</th>\
                                            <th>DATEVALIDATION</th>\
                                            <th>TEMPSVALIDATION</th>\
                                            <th>MOTIF</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                    </tbody>");
                                    for(var i=0;i < jsonresponse.length;i++){                          
                                        $("tbody").append("\
                                        <tr>\
                                        <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                        <td>"+jsonresponse[i]["NOM"]+"</td>\
                                        <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                        <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                        <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                        <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                        <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                        <td>"+jsonresponse[i]["TIREUR"]+"</td>\
                                        <td>"+jsonresponse[i]["ETABLISSEMENT"]+"</td>\
                                        <td>"+jsonresponse[i]["NCHEQUE"]+"</td>\
                                        <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                        </tr>");
                                    }
                                }
                                break;
                            case "versement":
                                if(jsonresponse.length==0){
                                    $("#containertable").append("<h2 class='notification' >Aucun resultat de votre recherche</h2>");
                            }else{
                                $(".table").append(
                                    "<thead>\
                                        <tr>\
                                            <th>MATRICULE</th>\
                                            <th>NOM</th>\
                                            <th>PRENOM</th>\
                                            <th>NATIONALITE</th>\
                                            <th>MAIL</th>\
                                            <th>NUMERO</th>\
                                            <th>DATE D'INSERTION</th>\
                                            <th>DATE DU VERSEMENT</th>\
                                            <th>AGENCE DU VERSEMENT</th>\
                                            <th>NUMERO DU BORDEREAUX</th>\
                                            <th>MONTANT</th>\
                                            <th>OBSERVATION</th>\
                                            <th>DATEVALIDATION</th>\
                                            <th>TEMPSVALIDATION</th>\
                                            <th>MOTIF</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                    </tbody>");
                                    for(var i=0;i < jsonresponse.length;i++){                          
                                        $("tbody").append("\
                                        <tr>\
                                        <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                        <td>"+jsonresponse[i]["NOM"]+"</td>\
                                        <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                        <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                        <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                        <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                        <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVERSEMENT"]+"</td>\
                                        <td>"+jsonresponse[i]["AGENCE"]+"</td>\
                                        <td>"+jsonresponse[i]["NBORDEREAUX"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                        <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                        </tr>");
                                    }
                                }
                                
                                break;
                            case "virement":
                                if(jsonresponse.length==0){
                                    $("#containertable").append("<h2 class='notification' >Aucun resultat de votre recherche</h2>");
                            }else{
                                $(".table").append(
                                    "<thead>\
                                        <tr>\
                                            <th>MATRICULE</th>\
                                            <th>NOM</th>\
                                            <th>PRENOM</th>\
                                            <th>NATIONALITE</th>\
                                            <th>MAIL</th>\
                                            <th>NUMERO</th>\
                                            <th>DATE D'INSERTION</th>\
                                            <th>DATE DU VIREMENT</th>\
                                            <th>NUMERO DU COMPTE</th>\
                                            <th>TITULAIRE DU COMPTE</th>\
                                            <th>MONTANT</th>\
                                            <th>OBSERVATION</th>\
                                            <th>DATEVALIDATION</th>\
                                            <th>TEMPSVALIDATION</th>\
                                            <th>MOTIF</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                    </tbody>");
                                    for(var i=0;i < jsonresponse.length;i++){                          
                                        $("tbody").append("\
                                        <tr>\
                                        <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                        <td>"+jsonresponse[i]["NOM"]+"</td>\
                                        <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                        <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                        <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                        <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                        <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVIREMENT"]+"</td>\
                                        <td>"+jsonresponse[i]["NCOMPTE"]+"</td>\
                                        <td>"+jsonresponse[i]["TITUCOMPTE"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                        <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                        </tr>");
                                    }
                                }
                                break;
                            case "western":
                                if(jsonresponse.length==0){
                                        $("#containertable").append("<h2 class='notification' >Aucun resultat de votre recherche</h2>");
                                }else{
                                    $(".table").append(
                                        "<thead>\
                                            <tr>\
                                                <th>MATRICULE</th>\
                                                <th>NOM</th>\
                                                <th>PRENOM</th>\
                                                <th>NATIONALITE</th>\
                                                <th>MAIL</th>\
                                                <th>NUMERO</th>\
                                                <th>DATE D'INSERTION</th>\
                                                <th>MONTANT ENVOYÉ</th>\
                                                <th>MONTANT A DEVOIR</th>\
                                                <th>NUMERO DE SUIVI</th>\
                                                <th>NOM DE L'EXPEDITEUR</th>\
                                                <th>OBSERVATION</th>\
                                                <th>DATEVALIDATION</th>\
                                                <th>TEMPSVALIDATION</th>\
                                                <th>MOTIF</th>\
                                            </tr>\
                                        </thead>\
                                        <tbody>\
                                        </tbody>");
                                        
                                        for(var i=0;i < jsonresponse.length;i++){                          
                                            $("tbody").append("\
                                            <tr>\
                                            <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                            <td>"+jsonresponse[i]["NOM"]+"</td>\
                                            <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                            <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                            <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                            <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                            <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                            <td>"+jsonresponse[i]["MONTANTWESTERN"]+"</td>\
                                            <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                            <td>"+jsonresponse[i]["NSUIVI"]+"</td>\
                                            <td>"+jsonresponse[i]["NOMEXP"]+"</td>\
                                            <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                            <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                            <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                            <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                            </tr>");
                                        }
                                }
                                break;
                            case "MoneyGram":
                                if(jsonresponse.length==0){
                                    $("#containertable").append("<h2 class='notification' >Aucun resultat de votre recherche</h2>");
                            }else{
                                $(".table").append(
                                    "<thead>\
                                        <tr>\
                                            <th>MATRICULE</th>\
                                            <th>NOM</th>\
                                            <th>PRENOM</th>\
                                            <th>NATIONALITE</th>\
                                            <th>MAIL</th>\
                                            <th>NUMERO</th>\
                                            <th>DATE D'INSERTION</th>\
                                            <th>DATE D'ENVOYE</th>\
                                            <th>REFERENCE</th>\
                                            <th>MONTANT ENVOYE</th>\
                                            <th>MONTANT A DEVOIR</th>\
                                            <th>NOM DE L'EXPEDITEUR</th>\
                                            <th>OBSERVATION</th>\
                                            <th>DATEVALIDATION</th>\
                                            <th>TEMPSVALIDATION</th>\
                                            <th>MOTIF</th>\
                                        </tr>\
                                    </thead>\
                                    <tbody>\
                                    </tbody>");
                                    for(var i=0;i < jsonresponse.length;i++){                          
                                        $("tbody").append("\
                                        <tr>\
                                        <td>"+jsonresponse[i]["MATRICULE"]+"</td>\
                                        <td>"+jsonresponse[i]["NOM"]+"</td>\
                                        <td>"+jsonresponse[i]["PRENOM"]+"</td>\
                                        <td>"+jsonresponse[i]["NATIONALITE"]+"</td>\
                                        <td>"+jsonresponse[i]["MAIL"]+"</td>\
                                        <td>"+jsonresponse[i]["NUMERO"]+"</td>\
                                        <td>"+jsonresponse[i]["DATESERVER"]+"</td>\
                                        <td>"+jsonresponse[i]["DATYMONEYGRAM"]+"</td>\
                                        <td>"+jsonresponse[i]["REFERENCE"]+"</td>\
                                        <td>"+jsonresponse[i]["EXPEDITEUR"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANTMONEYGRAM"]+"</td>\
                                        <td>"+jsonresponse[i]["MONTANT"]+"</td>\
                                        <td>"+jsonresponse[i]["OBSERVATION"]+"</td>\
                                        <td>"+jsonresponse[i]["DATEVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["TEMPSVALIDATION"]+"</td>\
                                        <td>"+jsonresponse[i]["MOTIF"]+"</td>\
                                        </tr>");
                                    }
                                }

                                break;
                        }
                        
                    },"JSON");
                    $("#exportclassificationtosheet").click(function(e){
                        e.preventDefault();
                        var wb = XLSX.utils.book_new();
                        wb.Props = {
                            Title: "CLASSIFICATION",
                            Subject: "CLASSIFICATION DES ETUDIANTS",
                            Author: "RAVELOJAONA TAHINA",
                            CreatedDate: new Date()
                        };
                        wb.SheetNames.push("classification");
                        var ws = XLSX.utils.table_to_sheet(document.getElementsByClassName("table")[0]);
                        wb.Sheets["allpaiement"] = ws;
                        var wbout = XLSX.write(wb, {bookType:'xlsx',  type: 'binary'});
                        var name=$("#modepaiement").val()+"classification.xlsx"
                        saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}),name);

                    
                    });
            });

           
            

        });

        $("#promo").click(function () {

            $("#welcoming").empty();
            $(".table").empty();
            $(".controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
       
        //SECTION NOTIFICATION
        /**
         * Notification d'une nouvelle paiement en MVOLA
         * CHEQUE
         * VIREMENT
         * VERSEMENT
         * WESTERN
         * MONEYGRAM
         */

        $("#MvolaVoir").click(function () {
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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
            $(".notif,#welcoming,.controleritem,.containerpromo,.controlpaiementavalable,.controlrecouvrement").remove();
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