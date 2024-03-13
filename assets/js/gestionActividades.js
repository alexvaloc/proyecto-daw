//Funcionalidad Botón Editar en la tabla de actividades
document.addEventListener("DOMContentLoaded", function() { //Espera que el DOM esté completamente cargado
    // Seleccionamos todos los botones "editar actividades"
    var editButtons = document.querySelectorAll('.btn-editar-act');
    var lastActividadId = null; // Variable para rastrear el último ID de actividad abierto

    // Función para mostrar/ocultar formulario
    function toggleEditForm(idActividad) {
        var form = document.getElementById('formularioEditarActividad');
        
        // Si se hace clic en el mismo botón, alternamos la visualización del formulario
        if (lastActividadId === idActividad) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
            lastActividadId = null; // Restablecemos el último ID de actividad
        } else {
            form.style.display = 'block'; // Mostramos el formulario
            form.querySelector('input[name="id_actividad"]').value = idActividad;
            lastActividadId = idActividad; // Actualizamos el último ID de actividad
        }
    }

//Asignamos el evento click a cada botón editar en la tabla de actividades

    editButtons.forEach(function(btn) {
        btn.addEventListener('click', function(){
            //obtenemos el id de la actividad
            var idActividad = this.getAttribute('data-id-actividad');
            var nombre = this.getAttribute('data-nombre');
            var descripcion = this.getAttribute('data-descripcion');
            var fecha = this.getAttribute('data-fecha');
            var duracion = this.getAttribute('data-duracion');
            var precio = this.getAttribute('data-precio');
            
            //Definimos el valor para cada input del formulario dinámico
            var form = document.getElementById('formularioEditarActividad');
            form.querySelector('input[name="id_actividad"]').value = idActividad;
            form.querySelector('input[name="nombre_actividad"]').value = nombre;
            form.querySelector('textarea[name="descripcion"]').value = descripcion;
            form.querySelector('input[name="fecha"]').value = fecha;
            form.querySelector('input[name="duracion"]').value = duracion;
            form.querySelector('input[name="Precio"]').value = precio;

            toggleEditForm(idActividad);
        });
    });
});

//Botón "Cerrar" formulario de actualización
document.addEventListener("DOMContentLoaded", function(){
    var formulario = document.getElementById('formularioEditarActividad');
    var btnCerrar = document.getElementById('btnCerrarFormularioAct');

    btnCerrar.addEventListener('click',function(){
        formulario.style.display='none';
    });
});