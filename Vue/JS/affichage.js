$(document).ready(function () {
    var ajourpromo=0;
    var ajourrecouvrement=0;
    $('#recouvrement').click(function (){
        clearInterval(ajourrecouvrement);
        clearInterval(ajourpromo);
        $("#welcoming").empty();
        $(".table").empty();
        $("#welcoming").append(
            "\
            <form class=\"mt-3 form-inline\" >\
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
    </div></form>\
    ");
                //alert("hello");

                $.ajax({
                    type: "GET",
                    url: "../Controller/ControlFinanceAffichage.php",
                    data: "recouvrement",
                    dataType: "json",
                    success: function (data){
                    var select= data;
                    for(var i = 0; i<select.length; i++){
                        $("#bo").append("<option value = '"+select[i]['DATEDENTER']+"'>"+select[i]['DATEDENTER']+"</option>");
                        }
                    }
                })
    
            var ajour = 0;
            var dateD = document.getElementById("bo").value;
            var month=$('#month').find('option:selected').val();
            var etat=$('#etat').find('option:selected').val();
            var motif=$('#motif').find('option:selected').val();
           // var dataR = 'inputdate='+ dateD + '&paiementstate='+ etat + '&motif='+ motif + '&mounth='+ month;
            $.ajax({
                type: "POST",
                url: "../Controller/ControlRecouvrement.php",
                data: {
                    inputdate : dateD,
                    paiementstate : etat,
                    motif : motif,
                    mounth : month
                },
                dataType: "json",
                success: function (dataa){
                    $(".table").empty();
                    $(".table").append("<thead><tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>EtatEcolage</th><th>Semestre</th><th>Tel</th><th>Inscription</th><th>Filière</th><th>Vague</th><th>Soutenance</th><th>Examen</th><th>Certificat</th></tr></thead>");
                    $(".table").append(
                        "<tbody></tbody>"
                    );
                    //alert(dataa);
                    var format = dataa;
                    //alert(format);
                    for(var i = 0; i<format.length; i++){
                        $("tbody").append(
                            "<tr><td>"+format[i]['MATRICULE']+"</td>\
                            <td>"+format[i]['NOM']+"</td>\
                            <td>"+format[i]['PRENOM']+"</td>\
                            <td>"+format[i]['ECOLAGE']+"</td>\
                            <td>"+format[i]['SEMESTRE']+"</td>\
                            <td>"+format[i]['NUMERO']+"</td>\
                            <td>"+format[i]['INSCRIPTION']+"</td>\
                            <td>"+format[i]['FILIERE']+"</td>\
                            <td>"+format[i]['CODE']+"</td>\
                            <td>"+format[i]['SOUTENANCE']+"</td>\
                            <td>"+format[i]['EXAMEN']+"</td>\
                            <td>"+format[i]['CERTIFICAT']+"</tr>\
                        ");
                    }
                    ajour=i;
                }
            });

            ajourrecouvrement = setInterval(function(){
                var ajour = 0;
                var dateD = document.getElementById("bo").value;
                var month=$('#month').find('option:selected').val();
                var etat=$('#etat').find('option:selected').val();
                var motif=$('#motif').find('option:selected').val();
                $.ajax({
                    type: "POST",
                    url: "../Controller/ControlRecouvrement.php",
                    data: {
                        inputdate : dateD,
                        paiementstate : etat,
                        motif : motif,
                        mounth : month
                    },
                    dataType: "json",
                    success: function (dataa){
                        $(".table").empty();
                        $(".table").append("<thead><tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>EtatEcolage</th><th>Semestre</th><th>Tel</th><th>Inscription</th><th>Filière</th><th>Vague</th><th>Soutenance</th><th>Examen</th><th>Certificat</th></tr></thead>");
                        $(".table").append(
                            "<tbody></tbody>"
                        );
                       // alert(dataa);
                        var format = dataa;
                        //alert(format);
                        for(var ajour = 0; ajour<format.length; ajour++){
                            $("tbody").append(
                                "<tr><td>"+format[ajour]['MATRICULE']+"</td>\
                                <td>"+format[ajour]['NOM']+"</td>\
                                <td>"+format[ajour]['PRENOM']+"</td>\
                                <td>"+format[ajour]['ECOLAGE']+"</td>\
                                <td>"+format[ajour]['SEMESTRE']+"</td>\
                                <td>"+format[ajour]['NUMERO']+"</td>\
                                <td>"+format[ajour]['INSCRIPTION']+"</td>\
                                <td>"+format[ajour]['FILIERE']+"</td>\
                                <td>"+format[ajour]['CODE']+"</td>\
                                <td>"+format[ajour]['SOUTENANCE']+"</td>\
                                <td>"+format[ajour]['EXAMEN']+"</td>\
                                <td>"+format[ajour]['CERTIFICAT']+"</tr>\
                            ");
                        }
                       
                    }
                });
            },1000);

    });
    $("#classification").click(function () {
        clearInterval(ajourrecouvrement);
        clearInterval(ajourpromo);
    $("#welcoming").empty();
    $(".table").empty();
    $("#welcoming").append(
        "<form class=\"mt-3 form-inline\" >\
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
    </div></form>\
    "
    );
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

$("#promo").click(function(){
    
    $("#welcoming").empty();
    $(".table").empty();
    $("#welcoming").append(
        "<br>\
        <div class=\"container\">\
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
    
    $('.genere').click(function(){
        $.ajax({
            type: "POST",
            dataType: "TEXT",
            url: "../Controller/ControlPromo.php",
            data: "create=OUI",
            success : function(data){  
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
            data: "utilisation="+choix,
            success : function(data){
                $(".ut").empty();
                for (var i = 0; i<data.length; i++){
                    $(".ut").append(
                        "<div class=\"card border-0 shadow-md shadow-hover w-auto col-8 sup\">\
                            <div class=\"card-body d-flex text-right align-items-center w-auto vue\">\
                                <button class=\"btn btn-danger text-white te\"><strong>X</strong></button>\
                                <p id="+data[i]['codepromo']+" class=\"mb-0 ml-2 w-auto col-12 im\">"+data[i]['codepromo']+"</p>\
                            </div>\
                        </div>\
                        <br>");
                }
                //suppression code promo dashboard
            var container=document.querySelectorAll(".card-body");

            for(let i=0;i<container.length;i++){
                container[i].firstElementChild.addEventListener("click",function () { 
                    $.ajax({
                        type: "POST",
                        url: "../Controller/ControlPromo.php",
                        data:{unset:"OUI",codepromo:container[i].lastElementChild.id},
                        dataType: "text",
                        success: function (response) {
                            if(response=="unset success"){
                                container[i].parentNode.style.transition="0.01s all 0s ease-in";
                                container[i].parentNode.style.transform="translate(0px,-30px)";
                                setTimeout(function(){
                                    container[i].parentNode.parentNode.removeChild(container[i].parentNode);
                                },20);
                            }
                        }
                    });
                    

                 },false);
            }

            },
        });

        ajourpromo=setInterval(function(){
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "../Controller/ControlAjaxAffichagePromo.php",
                data: "utilisation="+choix,
                success : function(data){
                    $(".ut").empty();
                    for (var i = 0; i<data.length; i++){
                        $(".ut").append(
                            "<div class=\"card border-0 shadow-md shadow-hover w-auto col-8 sup\">\
                                <div class=\"card-body d-flex text-right align-items-center w-auto vue\">\
                                    <button class=\"btn btn-danger text-white te\"><strong>X</strong></button>\
                                    <p id="+data[i]['codepromo']+" class=\"mb-0 ml-2 w-auto col-12 im\">"+data[i]['codepromo']+"</p>\
                                </div>\
                            </div>\
                            <br>");
                    }
                    //suppression code promo dashboard
                var container=document.querySelectorAll(".card-body");
    
                for(let i=0;i<container.length;i++){
                    container[i].firstElementChild.addEventListener("click",function () { 
                        $.ajax({
                            type: "POST",
                            url: "../Controller/ControlPromo.php",
                            data:{unset:"OUI",codepromo:container[i].lastElementChild.id},
                            dataType: "text",
                            success: function (response) {
                                if(response=="unset success"){
                                    container[i].parentNode.style.transition="0.01s all 0s ease-in";
                                    container[i].parentNode.style.transform="translate(0px,-30px)";
                                    setTimeout(function(){
                                        container[i].parentNode.parentNode.removeChild(container[i].parentNode);
                                    },20);
                                }
                            }
                        });
                        
    
                     },false);
                }
    
                },
            });
        },1000);

        
    });
    
});

});
