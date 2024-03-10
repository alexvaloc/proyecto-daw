document.getElementById('btnEditarViaje').addEventListener('click', function() {
    var form = document.getElementById('formularioEditarViaje');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});

document.getElementById('btnAnadirDestino').addEventListener('click', function() {
    var form = document.getElementById('formularioAnadirDestino');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});