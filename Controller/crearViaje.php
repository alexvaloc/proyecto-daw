<?php

require_once __DIR__ . '/../entities/Viaje.php';
require_once __DIR__ . '/../model/ViajeModel.php';
require_once __DIR__ . '/../controller/ViajeController.php';

// Verificar la sesión del usuario
session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: ../index.php");
        exit;
    }else{
        $usuario = $_SESSION['usuario'];
    }

if($_SERVER['REQUEST_METHOD'] ==='POST'){
    $viaje = new Viaje();
    $viaje->setNombreViaje($_POST['nombre_viaje']);
    $viaje->setFechaInicio($_POST['fecha_inicio']);
    $viaje->setFechaFin($_POST['fecha_fin']);
    $viaje->setPresupuestoTotal($_POST['presupuesto_total']);
    $viaje->setIdUsuario($usuario['id_usuario']);

    $viajeController = new ViajeController();

    if ($viajeController->crearViajeController($viaje)) {
        $_SESSION['mensaje'] = "Viaje creado con éxito.";
    } else {
        $_SESSION['mensaje'] = "Error al crear el viaje.";
    }

    header("Location: ../View/TableroDeViajes.php");
    exit;

}
?>