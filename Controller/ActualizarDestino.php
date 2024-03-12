<?php

require_once __DIR__ . '/../entities/Destino.php';
require_once __DIR__ . '/../model/DestinoModel.php';
require_once __DIR__ . '/../controller/DestinoController.php';

// Verificar la sesión del usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $destinoController = new DestinoController();

    //Recogemos los datos del formulario
    $idViaje = $_POST['id_viaje'];
    $idDestino = $_POST['id_destino'];
    $nombreDestino = $_POST['nombre_destino'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    

    //Crear una instancia de la entidad destino

    $destino = new Destino($nombreDestino,$fechaInicio,$fechaFin,$idViaje,$idDestino);

    if($destinoController->actualizarDestinoController($destino)){
        $_SESSION['mensaje'] = "Destino actualizado correctamente";
    }else{
       $_SESSION['mensaje'] = "Error al actualizar el destino";
    }

     header("Location: ../View/gestionViaje.php?id_viaje=" . urlencode($idViaje));
     exit;

}