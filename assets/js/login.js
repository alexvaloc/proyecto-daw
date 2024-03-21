//Función para mostrar el formulario de registro o de login
function toggleForms(){
    const formularioRegistro = document.getElementById('registro-form');
    const formularioLogin = document.getElementById('login-form');

    if(formularioRegistro.style.display === 'none'){
        formularioRegistro.style.display = 'block';
        formularioLogin.style.display = 'none';
    }else{
        formularioRegistro.style.display = 'none';
        formularioLogin.style.display = 'block';
    }
}

//Función para mostrar los mensajes de éxito/error durante un tiempo determinado
function hideMessage(id){
    setTimeout(function(){
        var element = document.getElementById(id);
        if(element){
            element.style.display='none';
        }
    }, 3000);
}

document.addEventListener('DOMContentLoaded', (event) => {
    //Verificamos si existe el mensaje de registro, para ocultarlo después de unos segundos
    if(document.getElementById('mensaje-registro')){
        hideMessage('mensaje-registro');
    }
    //Verificamos si existe el mensaje de login, para ocultarlo después de unos segundos
    if(document.getElementById('mensaje-login')){
        hideMessage('mensaje-login');
    }
    //Verificamos si existe algún otro mensaje, para ocultarlo después de unos segundos
    if(document.getElementById('mensaje')){
        hideMessage('mensaje');
    }
});