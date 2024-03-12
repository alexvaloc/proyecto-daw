<?php

require_once __DIR__ . '/../controller/ViajeController.php';

session_start();

if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idViaje = $_POST['id_viaje'] ?? null;
    $idUsuario =$_SESSION['id_usuario'];

    $viajeController = new ViajeController();

    if($viajeController->eliminarViajeController($idViaje, $idUsuario)){
        $_SESSION['mensaje'] = "Viaje eliminado correctamente.";
    }else{
        $_SESSION['mensaje'] = "Error al eliminar el viaje.";
    }

    header("Location: ../View/TableroDeViajes.php");
    exit;
}

?>
