<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Dependencias

require_once __DIR__ . "/../Entities/Viaje.php";
require_once __DIR__ . "/../Model/ViajeModel.php";
require_once __DIR__ . "/ViajeController.php";

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen_viaje'])){
    //Recojemos el id y la ruta del formulario en dos variables
    $idViaje = $_POST['id_viaje'];
    $imagenViaje = $_FILES['imagen_viaje'];

    //Validamos el archivo
    if($imagenViaje['error'] !== UPLOAD_ERR_OK){
        $_SESSION['mensaje'] = "Error al subir la imagen.";
        header("Location: ../View/TableroDeViajes.php");
        exit;
    }

    //Definimos la ruta de la imagen

    $directorioDestino = __DIR__ . '/../assets/uploads/';
    $nombreImagen = uniqid('viaje_'.$idViaje . '_') . basename($imagenViaje['name']);
    $rutaArchivo = $directorioDestino . $nombreImagen;


    //Trasladamos la imagen al directorio destino
    //$_FILE['tmp_name'] -> Es la dirección temporal del archivo
    if(move_uploaded_file($imagenViaje['tmp_name'], $rutaArchivo)){
        //Actualizamos la ruta de la imagen en la base de datos
        $viajeController = new ViajeController();

        if($viajeController->actualizarImagenViajeController($idViaje, $nombreImagen)){
            $_SESSION['mensaje'] = "Imagen actualizada";
        }else{
            $_SESSION['mensaje'] = "Error al actualizar la imagen en la base de datos";
        }
    }else{
        $_SESSION['mensaje'] = "Error al guardar la imagen";
    }

    header("Location: ../View/TableroDeViajes.php");
    exit;

}