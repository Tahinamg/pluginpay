$("document").ready(function(){
    var dashboard= document.querySelector(".page-header");
    dashboard.style.height=window.innerHeight + "px";
    
    $("#notification").click(
        function(){
            $(".notificationsubmain").slideToggle("fast");
        }
    );
});

