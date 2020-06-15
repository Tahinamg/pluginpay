//UPLOAD
$(document).ready(function () {
  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = document.cookie;
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
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

  $("#codepromo").keyup(function (e) {

    if (e.key == "Enter" || e.key == "Control") {
      e.preventDefault();
    } else {
      var codepromovalue = $(this).val();

      $.post("../Controller/ControlPromotion.php", { codepromo: codepromovalue, Origin: getCookie("Origin"), Semestre: getCookie("Semestre"), Inscription: getCookie("Inscription") }, function (data) {
        if (data == 0) {
          $("strong.text-danger.invalidpromo").show();
          $("strong.text-success.validpromo").hide();


        } else if (data != 0) {
          $('[name="montant"]').val(data);
          $('#Panier').text(data);
          $("#codepromo").attr("readonly", "readonly");
          $("strong.text-danger.invalidpromo").hide();
          $("strong.text-success.validpromo").show();
        }
      }, "text");
    }
  });
 
});