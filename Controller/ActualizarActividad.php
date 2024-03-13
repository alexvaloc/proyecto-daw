<?php

require_once __DIR__ . '/../entities/Actividad.php';
require_once __DIR__ . '/../model/ActividadModel.php';
require_once __DIR__ . '/ActividadController.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Creamos una instancia ActividadController 
    $actividadController = new ActividadController();

    //Asignamos los valores del formulario
    $nombreActividad = $_POST['nombre_actividad'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['Precio'];
    $idDestino = $_POST['id_destino'];
    $idActividad =$_POST['id_actividad'];

    //Creamos un objeto Actividad
    $actividad = new Actividad($nombreActividad, $descripcion, $fecha, $duracion, $precio, $idActividad, $idDestino);

    if ($actividadController->actualizarActividadController($actividad)) {
        $_SESSION['mensaje'] = "Actividad actualizada con éxito.";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la actividad.";
    }

    header("Location: ../View/gestionActividades.php?id_destino=" . urlencode($idDestino));
    exit;
}