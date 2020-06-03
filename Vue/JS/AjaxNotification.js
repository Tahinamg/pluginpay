$("document").ready(function(){
    //display number of mvola
    //TODO AVERINA UPLOADENA
    setInterval(function () { 
        $.ajax({
            type: "GET",
            data:"paiement=MobileMoney",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#MvolaNotif").text(response);
            }
        });
     },3000);
     setInterval(function(){
        $.ajax({
            type: "GET",
            data:"paiement=Virement",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#VirementNotif").text(response);
            }
        });
     },3000);


     setInterval(function(){
        $.ajax({
            type: "GET",
            data:"paiement=Versement",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#VersementNotif").text(response);
            }
        });
     },3000);

     setInterval(function(){
        $.ajax({
            type: "GET",
            data:"paiement=Cheque",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#ChequeNotif").text(response);
            }
        });
     },3000);

     setInterval(function () { 
        $.ajax({
            type: "GET",
            data:"paiement=Western",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#WesternNotif").text(response);
            }
        });
     },3000);



     });
    
