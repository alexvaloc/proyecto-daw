//Función para esconder el mensaje de alerta después de unos segundos
document.addEventListener("DOMContentLoaded", function(){

    var alertBox= document.getElementById("alert-box");
    if(alertBox){
        setTimeout(function(){
            alertBox.style.display = "none";
        },5000);
    }
});