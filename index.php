<?php

//Definimos esta dirección como directorio raiz del proyecto
define('ROOT_DIR', __DIR__);

//Dependencias
require_once 'controller/UsuarioController.php';

//REGISTRO DE USUARIO
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
        $mensajeRegistro =  "Usuario registrado correctamente.";
    } else {
        $mensajeRegistro = "Error al registrar el usuario.";
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
        $mensajeLogin = "Error en el inicio de sesión. Las credenciales son incorrectas.";
    }
}



//CERRAR SESIÓN

if (isset($_GET['cerrarSesion'])) {
  $usuarioController = new UsuarioController();
  $mensaje = $usuarioController->cerrarSesion();
    header("Location: index.php?mensaje=".urlencode($mensaje));
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Fuente Popins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!--CSS de LOGIN-->
    <link rel="stylesheet" href="./assets/css/login.css">
    <!--BOOTSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Registro de Usuario</title>
</head>
<body>
    <!--Contenedor principal-->
     <div class="wrapper">

    <!--Script para mostrar mensajes éxito/error-->
    <?php if(isset($mensajeRegistro)):?>
        <div id="mensaje-registro" class="alert alert-success" role="alert">
            <?php echo $mensajeRegistro; ?>
        </div>
    <?php endif; ?>
    <?php if(isset($mensajeLogin)):?>
        <div id="mensaje-login" class="alert alert-danger" role="alert">
            <?php echo $mensajeLogin; ?>
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['mensaje'])): ?>
        <div id="mensaje" class="alert alert-info" role="alert">
            <?php echo htmlspecialchars(($_GET['mensaje'])); ?>
        </div>
    <?php endif; ?>
        <!--Estrctura del Login-->
        <div class="container main">
            <div class="row ">
                <div class="col-md-6 side-image">
                    <div class="text">
                        <p class="text-center">Únete a la comunidad de viajeros de <i>MYTRA</i></p>
                    </div>                    
                </div>
                <!--Formulario de registro-->
                <div class="col-md-6 right">
                    <div class="input-box" id="registro-form">
                        <form method="POST" action="index.php">
                            <div class="header-logo">
                                <header class="header-title">CREAR UNA CUENTA</header>
                            </div>
                                <div class="input-field">
                                <label for="nombre">Nombre:</label>
                                <input class="input" type="text" name="nombre" required>
                            </div>
                            <div class="input-field">
                                <label for="email">Email:</label>
                                <input class="input" type="email" name="email" required>
                            </div>
                            <div class="input-field">
                                <label for="contraseña">Contraseña:</label>
                                <input class="input" type="password" name="contraseña" required>
                            </div>
                            <div class="input-field">
                                <input class="submit" type="submit" name="registro" value="Registrar">
                            </div>
                        </form>
                        <div class="signin">
                            <span>¿Ya estás registrado? <a href="#" onclick="toggleForms()">Inicia sesión aquí</a></span>
                        </div>
                    </div>
                    <!--Formulario de Inicio de sesión-->
                    <div class="input-box" id="login-form" style="display:none;">
                        <form method="POST" action="index.php">
                            <div class="header-logo">
                                <header class="header-title">INICIAR SESIÓN</header>
                            </div>
                            <div class="input-field">
                                <label for="login-email">Email:</label>
                                <input class="input" type="email" name="email" required>
                            </div>
                            <div class="input-field">
                                <label for="login-contraseña">Contraseña:</label>
                                <input class="input" type="password" name="contraseña" required>
                            </div>
                            <div class="input-field">
                                <input class="submit" type="submit" name="login" value="Iniciar Sesión">
                            </div>
                        </form>
                        <div class="signin">
                            <span>¿No tienes una cuenta? <a href="#" onclick="toggleForms()">Crea una aquí</a></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
    

  <!--BOOTSTRAP JS-->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!--Scripts JS-->
  <script src="./assets/js/login.js"></script>
</body>
</html>