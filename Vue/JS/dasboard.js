$("document").ready(function(){
    var dashboard= document.querySelector(".page-header");
    dashboard.style.height=window.innerHeight + "px";
    
    $("#notification").click(
        function(){
            $(".notificationsubmain").slideToggle("fast");
        }
    );
    $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#content-wrapper").toggleClass("toggled");
  });
});

