$("document").ready(function(){
    var dashboard= document.querySelector(".page-header");
    dashboard.style.height=window.innerHeight + "px";
    
    $("#notification").click(
        function(e){
            e.preventDefault();
            $(".notificationsubmain").slideToggle("fast");
        }
    );
    $("#search").click(
        function(e){
            e.preventDefault();
            $(".searchsubmain").slideToggle("fast");
        }
    );
    $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#content-wrapper").toggleClass("toggled");
  });
});

