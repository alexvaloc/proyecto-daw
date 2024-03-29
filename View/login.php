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
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <!--BOOTSTRAP CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Login</title>
</head>
<body>
<div class="wrapper">
        <div class="container main">
            <div class="row ">
                <div class="col-md-6 side-image">
                    <div class="text">
                        <p>Únete a la comunidad de viajeros de <i>MYTRA</i></p>
                    </div>                    
                </div>
                <div class="col-md-6 right">
                    <div class="input-box">
                        <form method="POST" action="index.php">
                            <div class="header-logo">
                            <header>CREAR UNA CUENTA</header>
                             <!--Imagen-->
                             <img class="logo" src="./assets/img/logo.png" alt="Imagen de viaje">
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
                            <span>¿Ya estás registrado? <a href="#">Inicia sesión aquí</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
 
  <!--BOOTSTRAP JS-->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>