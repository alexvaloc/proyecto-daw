<?php
//dependencias
require_once __DIR__ . '/../controller/ViajeController.php';

session_start();
//si no se ha iniciado sesión, redirigir al index.php
if(!isset($_SESSION['usuario'])){
    header ("Location: ../index.php");
    exit;
}

//Manejo de los datos del formulario para eliminar un viaje
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
