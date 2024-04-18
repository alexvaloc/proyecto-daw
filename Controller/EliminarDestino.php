<?php
//dependencias
require_once __DIR__ . '/../controller/DestinoController.php';

session_start();
//si no se ha iniciado sesión, redirigir al index.php
if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}

//Manejo de los datos para eliminar un destino
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $idDestino = $_POST['id_destino'];
    $idViaje = $_POST['id_viaje'];

    $destinoController = new DestinoController();
    $resultado = $destinoController->eliminarDestinoController($idDestino);

    if($resultado){
        $_SESSION['mensaje'] = "Destino eliminado correctamente";
    }else{
        $_SESSION['mensaje'] = "Error al eliminar el destino.";
    }

    header("Location: ../View/gestionViaje.php?id_viaje=" . urlencode($idViaje));
    exit;
}