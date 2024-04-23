<?php

require_once __DIR__ . '/../Controller/DestinoController.php';
require_once __DIR__ . '/../Entities/Destino.php';

//Iniciamos sesión
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
    exit;
}

//Verificamos que el formulario ha sido enviado
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
    //Recogemos los valores del formulario
        $nombreDestino = $_POST['nombre_destino'];
        $fechaInicio = $_POST['fecha_inicio'];
        $fechaFin = $_POST['fecha_fin'];
        $idViaje = $_POST['id_viaje'];


    //Instanciamos el objeto Destino
        $destino = new Destino();
        $destino->setNombreDestino($nombreDestino);
        $destino->setFechaInicio($fechaInicio);
        $destino->setFechaFin($fechaFin);
        $destino->setIdViaje($idViaje);

    //Instanciamos el controlador
        $destinoController = new DestinoController();

    //Llamamos al método para crear el destino
        $resultado = $destinoController->crearDestinoController($destino);

    //Mensajes basados en el resultado del método
        if($resultado){
            $_SESSION['mensaje'] = "Destino añadido con éxito.";
        }else{
            $_SESSION['mensaje'] = "Error al añadir el destino";
        }

    //Redirigimos al usuario de vuelta a gestiónViaje
        header("Location: ../View/gestionViaje.php?id_viaje=" . urlencode($idViaje));
        exit;
    }catch(Exception $e){
        $_SESSION['mensaje'] = $e->getMessage();
        header("Location: " . $_SERVER['HTTP_REFERER']); //Esto redirige al usuario a la página anterior
    }
}