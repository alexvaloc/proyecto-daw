<?php

require_once __DIR__ . "/ViajeController.php";
require_once __DIR__ . "/../Entities/Viaje.php";

// Verificar la sesión del usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

//Comprobar si el formulario fue enviado

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $viajeController = new ViajeController();

    //Recogemos los datos del formulario
    $id_usuario = $_SESSION['id_usuario'];
    $idViaje = $_POST['id_viaje'] ?? null;
    $nombreViaje = $_POST['nombre_viaje'] ?? "";
    $fechaInicio = $_POST['fecha_inicio'] ?? "";
    $fechaFin = $_POST['fecha_fin'] ?? "";
    $presupuestoTotal = $_POST['presupuesto_total'] ?? 0;

      

     // Crear instancia de la entidad Viaje
     $viaje = new Viaje($nombreViaje, $fechaInicio, $fechaFin, $presupuestoTotal, $id_usuario, $idViaje);
    
     if($viajeController->actualizarViajeController($viaje)){
        $_SESSION['mensaje'] = "Viaje actualizado correctamente";
     }else{
        $_SESSION['mensaje'] = "Error al actualizar el viaje";
     }

     header("Location: ../View/TableroDeViajes.php");
     exit;

}