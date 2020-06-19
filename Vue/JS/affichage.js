$("#classification").click(function () {
    $("#welcoming").empty();
    $(".table").empty();
    $("#welcoming").append(
        "<div class=\"d-flex justify-content-center\">\
        <select name=\"option\" id=\"option\" class=\"p-2\">\
            <option>Niveau d\'étude</option>\
            <option value=\"LICENCE\">Licence</option>\
            <option value=\"MASTER\">Master</option>\
        </select>\
        <select name=\"parcours\" id=\"parcours\" class=\"ml-4 p-2\">\
            <option>Filière</option>\
            <option value=\"TIC\">TIC</option>\
            <option value=\"CAN\">CAN</option>\
            <option value=\"MPJ\">MPJ</option>\
            <option value=\"MGT\">MGT</option>\
            <option value=\"DRT\">DRT</option>\
        </select>\
        <select name=\"vague\" id=\"vague\" class=\"ml-4 p-2\">\
            <option>Vague</option>\
            <option value=\"V1\">V1</option>\
            <option value=\"V2\">V2</option>\
            <option value=\"V3\">V3</option>\
            <option value=\"V4\">V4</option>\
            <option value=\"V5\">V5</option>\
            <option value=\"V6\">V6</option>\
            <option value=\"V7\">V7</option>\
            <option value=\"V8\">V8</option>\
            <option value=\"V9\">V9</option>\
            <option value=\"V10\">V10</option>\
        </select>\
    </div>\
    <br>\
    <br>\
    <table id=\"user_data\" class=\"table table-bordered table-striped\">\
        <thead>\
            <tr>\
                <th width=\"10%\">IDetudiant</th>\
                <th width=\"20%\">Semestre</th>\
                <th width=\"20%\">Ecolage</th>\
                <th width=\"10%\">Examen</th>\
                <th width=\"10%\">Soutenance</th>\
                <th width=\"10%\">Certificat</th>\
                <th width=\"10%\">DateInscription</th>\
                <th width=\"10%\">Profil</th>\
            </tr>\
        </thead>\
    </table>\
    <script>\
      $(document).ready( function () {\
    $('#user_data').DataTable();\
} );\
    </script>"
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
                                <p id="+data[i]['codepromo']+" class=\"mb-0 ml-2 w-auto im\">"+data[i]['codepromo']+"</p>\
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
    });
    
});
$(document).ready(function () {
    $('#user_data').DataTable();
});