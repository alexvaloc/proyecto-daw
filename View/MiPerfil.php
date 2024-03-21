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
     <!--BOOTSTRAP CSS-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Mi Perfil</title>
</head>
<body>
    <!-- Formulario para editar perfil -->
<h2>Editar perfil</h2>

<?php if (isset($_SESSION['mensaje'])): ?>
    <p><?= $_SESSION['mensaje']; ?></p>
    <?php unset($_SESSION['mensaje']); // Elimina el mensaje de la sesión después de mostrarlo ?>
<?php endif; ?>

<form method="POST" action="../Controller/ActualizarPerfil.php">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= $_SESSION['nombre'] ?>" required><br><br>
    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" value="<?= $_SESSION['email'] ?>" required><br><br>
    <label for="contraseña">Nueva Contraseña:</label>
    <input type="password" name="contraseña" id="contraseña" placeholder="Ingresa nueva contraseña"><br><br>
    <label for="confirmar_contraseña">Confirmar Nueva Contraseña:</label>
    <input type="password" name="confirmar_contraseña" id="confirmar_contraseña" placeholder="Confirma nueva contraseña"><br><br>
    <input type="submit" name="editar_perfil" value="Guardar Cambios">
</form>

<a href="./TableroDeViajes.php">Tablero de viajes</a>

<!--BOOTSTRAP JS-->  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>