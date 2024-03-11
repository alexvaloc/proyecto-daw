<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>
</html>