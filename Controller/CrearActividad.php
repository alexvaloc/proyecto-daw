<?php

require_once __DIR__ . '/../Controller/ActividadController.php';
require_once __DIR__ . '/../Entities/Destino.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}

//Verificamos que el formulario ha sido enviado

try{
    //Recojemos los valores del formulario
    $nombreActividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['Precio'];
    $idActividad = $_POST['id_actividad'];
    $idDestino = $_POST['id_destino'];

    //Instanciamos el objeto Actividad

    $actividad = new Actividad();
    $actividad->setNombreActividad($nombreActividad);
    $actividad->setDescripcion($descripcion);
    $actividad->setFecha($fecha);
    $actividad->setDuracion($duracion);
    $actividad->setPrecio($precio);
    $actividad->setIdDestino($idDestino);

    //Instanciamos un objeto controlador de actividad
    $actividadControler = new ActividadController();

    $resultado = $actividadControler->crearActividadController($actividad);

    //Mensajes según el resultado de crearActividadController
    if($resultado){
        $_SESSION['mensaje'] = "Actividad añadida con éxito.";
    }else{
        $_SESSION['mensaje'] = "Error al añádir la actividad";
    }

    //Redirigimos de vuelta a gestiónActividades
    header("Location: ../View/gestionActividades.php?id_destino=" . urlencode($idDestino));


}catch(Exception $e){
    $_SESSION['mensaje'] = $e->getMessage();
    header("Location: " . $_SERVER['HTTP_REFERER']); //Esto redirige al usuario a la página anterior
}
