<?php

define('ROOT_DIR', __DIR__);

require_once 'controller/UsuarioController.php';
//REGISTRO

// Crear una instancia del controlador de usuario
$usuarioController = new UsuarioController();

// Verificar si se ha enviado el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    //Registrar el usuario
    if ($usuarioController->registrarUsuarioController($nombre, $email, $contraseña)) {
        echo "<br>Usuario registrado correctamente.";
    } else {
        echo "<br>Error al registrar el usuario.";
    }
}

//INICIO DE SESIÓN

//Verificar si se ha enviado el formulario de inicio de sesión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
    //Obtener los datos de inicio de sesión
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    //Llamamos al controlador de inicio de sesión

    if($usuarioController->iniciarSesionController($email,$contraseña)){
        //Si el inicio se realiza con éxito, redirigimos a la vista "TableroDeViajes"
        header ("Location: View/TableroDeViajes.php");

        exit; //Asegura que el script se detenga después de redirigir
    }else{
        //Si el inicio no se realiza con éxito, mostramos mensaje de error
        echo "Error en el inicio de sesión. Las credenciales son incorrectas.<br>";
    }
}

//CERRAR SESIÓN

if (isset($_GET['cerrarSesion'])) {
  $usuarioController = new UsuarioController();
  $mensaje = $usuarioController->cerrarSesion();
    header("Location: index.php?mensaje=".urlencode($mensaje));
    exit;
}

if(isset($_GET['mensaje'])) {
    echo "<p>{$_GET['mensaje']}</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form method="POST" action="index.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required><br><br>
        <input type="submit" name="registro" value="Registrar">
    </form>

    <h1>Iniciar Sesión</h1>
    <form method="POST" action="index.php">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required><br><br>
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
</body>
</html>