/*THIS module allow the financial to show the notification of the transaction
* AjaxNotification 1.0,
* (c) Ravelojaona Tahina Natanaela
*/
$("document").ready(function(){
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

     setInterval(function () { 
        $.ajax({
            type: "GET",
            data:"paiement=MoneyGram",
            url: "../Controller/ControlFinanceNotification.php",
            dataType: "text",
            success: function (response) {
                $("#MoneyGramNotif").text(response);
            }
        });
     },3000);



     });
    
