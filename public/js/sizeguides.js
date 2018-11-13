$(function(){
    console.log('init size guide');
   /* var el_sizeguide = document.createElement("div");
    el_sizeguide.className = "sizeguide-container";

    var h = document.getElementById("myH2");
    h.insertAdjacentHTML("afterend", $('#ProductPrice'));*/
    loadCss();
    function loadCss() {
        var link = document.createElement("link");
        link.href = "https://dattq.stickervn.com/shopify-app-by-laravel/public/css/sizeguide-front-end.css";
        link.type = "text/css";
        link.rel = "stylesheet";
        link.media = "screen,print";
        document.getElementsByTagName("head")[0].appendChild(link);
    }
});