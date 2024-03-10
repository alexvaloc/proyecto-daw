<?php

require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../model/UsuarioModel.php';
require_once __DIR__ . '/../controller/UsuarioController.php';

// Verificar la sesión del usuario
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

// Crear una instancia del controlador de usuario
$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuario = $_SESSION['id_usuario'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    //Llamamos al controlador
    $respuesta = $usuarioController->actualizarUsuarioController($id_usuario,$nombre,$email,$contraseña,$confirmar_contraseña);
    
    if($respuesta === true){
        $_SESSION['nombre'] = $nombre;
        $_SESSION['email'] = $email;
        $_SESSION['mensaje'] = "Perfil actualizado correctamente";

    }else{
    //Mostramos mensaje de error desde el controlador
        $_SESSION['mensaje'] = "Error al actualizar el perfil";
    }

    header ("Location: ../View/MiPerfil.php");
    exit;
}
?>
