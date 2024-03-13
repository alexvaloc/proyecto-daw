<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../controller/ActividadController.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $idDestino = $_GET['id_destino'];
    $idActividad = $_GET['id_actividad'];

    $actividadController = new ActividadController();
    $resultado = $actividadController->eliminarActividadController($idDestino,$idActividad);

    if($resultado){
        $_SESSION['mensaje'] = "Actividad eliminada correctamente";
    }else{
        $_SESSION['mensaje'] = "Error al eliminar la actividad.";
    }

    header("Location: ../View/gestionActividades.php?id_destino=" . urlencode($idDestino));
    exit;
}