<?php

require_once __DIR__ . '/../controller/DestinoController.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_destino'])){
    $idDestino = $_POST['id_destino'];
    $idViaje = $_POST['id_viaje'];

    $destinoController = new DestinoController();
    $resultado = $destinoController->eliminarDestinoController($idDestino,$idViaje);

    if($resultado){
        $_SESSION['mensaje'] = "Destino eliminado correctamente";
    }else{
        $_SESSION['mensaje'] = "Error al eliminar el destino.";
    }

    header("Location: ../View/gestionViaje.php?id_viaje=" . urlencode($idViaje));
    exit;
}