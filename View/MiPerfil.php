<?php

session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS propios -->
    <link rel="stylesheet" href="../assets/css/btn.css">
    <link rel="stylesheet" href="../assets/css/tablero-viajes.css">
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Mi Perfil</title>
</head>
<body style="background: #ececec;">

<?php include './navbar.php'; ?>
    

    <!--mensaje exito/error-->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-info text-center"><?php echo $_SESSION['mensaje']; ?></div>
            <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
        <?php endif; ?>

<!-- Formulario para editar perfil -->
<div class="container mt-4">
<div class="row mb-3">
            <div class="col-lg-12">
                <h1 class="display-4 my-2">Editar perfil</h1>             
            </div>
        </div>

    <form method="POST" class="row g-3" action="../Controller/ActualizarPerfil.php">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" class="form-control" name="nombre" class="form-label" value="<?= $_SESSION['nombre'] ?>" required><br><br>

        <label for="email" class="form-label">Correo electrónico:</label>
        <input type="email" class="form-control" name="email" value="<?= $_SESSION['email'] ?>" required>
        <hr>
        <p class="lead">Cambia tu contraseña:</p>

        <label for="contraseña" class="form-label">Nueva Contraseña:</label>
        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingresa nueva contraseña">

        <label for="confirmar_contraseña" class="form-label">Confirmar Nueva Contraseña:</label>
        <input type="password" class="form-control" name="confirmar_contraseña" id="confirmar_contraseña" placeholder="Confirma nueva contraseña">

        <input type="submit" class="btn btn-primary my-4" name="editar_perfil" value="Guardar Cambios">
    </form>
</div>


<!--BOOTSTRAP JS-->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>