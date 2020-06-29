window.addEventListener("load",function(){
    this.setTimeout(function(){
        var loader=document.querySelector("#loading");
        var contenupaiement=document.querySelector("#contenupaiement");
        loader.style.transition="1s 0s all ease";
        loader.style.opacity=0;
        setTimeout(function(){
        loader.style.display="none";
        contenupaiement.style.transition="0.5s 0s all ease";
        contenupaiement.style.display="block";
        contenupaiement.style.opacity=1;
        
        },1000);
    },5000);
},false);