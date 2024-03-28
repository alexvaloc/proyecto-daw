document.getElementById('btnEditarViaje').addEventListener('click', function() {
    var form = document.getElementById('formularioEditarViaje');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('btnAnadirDestino').addEventListener('click', function() {
    var formulario = document.getElementById('formularioAnadirDestino');
    var botonAnadir = document.getElementById('btnAnadirDestino');
    var botonCancelar = document.getElementById('btnAnadirDestinoCancel');

    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
    botonAnadir.style.display = botonAnadir.style.display === 'none' ? 'block' : 'none';
    botonCancelar.style.display = botonCancelar.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('btnAnadirDestinoCancel').addEventListener('click',function(){
    var formulario = document.getElementById('formularioAnadirDestino');
    var botonAnadir = document.getElementById('btnAnadirDestino');
    var botonCancelar = document.getElementById('btnAnadirDestinoCancel');

    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
    botonAnadir.style.display = botonAnadir.style.display === 'none' ? 'block' : 'none';
    botonCancelar.style.display = botonCancelar.style.display === 'none' ? 'block' : 'none';
});


function toggleEditarDestinoForm(idDestino){
    var form = document.getElementById('formularioEditarDestino-' + idDestino);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

/* Modal para tarjetas destino, dependiendo de su ID */

document.addEventListener('DOMContentLoaded', (event) => {
    //Recojemos la ventana modal en una variable
    var editModalElement = document.getElementById('editDestinationModal');
    var editModal = new bootstrap.Modal(editModalElement);

    editModalElement.addEventListener('show.bs.modal', function (event) {
        // Botón que activa la ventana modal
        var button = event.relatedTarget;

        // Recogemos la informacion de los atributos  data-bs
        var id = button.getAttribute('data-id');
        var nombre = button.getAttribute('data-nombre');
        var fechaInicio = button.getAttribute('data-fecha-inicio');
        var fechaFin = button.getAttribute('data-fecha-fin');

        // Actualizamos el contenido de la ventana modal
        var modalTitle = editModalElement.querySelector('.modal-title');
        var form = editModalElement.querySelector('form');

        // Ponemos los valores del destino seleccionado
        form.querySelector('[name="id_destino"]').value = id;
        form.querySelector('[name="nombre_destino"]').value = nombre;
        form.querySelector('[name="fecha_inicio"]').value = fechaInicio;
        form.querySelector('[name="fecha_fin"]').value = fechaFin;

        // // Optional: Update the modal's title if needed
        // modalTitle.textContent = 'Editar ' + nombre;
    });
});