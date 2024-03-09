<?php

require_once __DIR__ . '/Conexion.php';

//Clase UsuarioModel
class UsuarioModel{
    
    private $db;

    //creamos la conexión 
    public function __construct(){
        $this->db= crearConexion();
    }

    //Funcion para registrar nuevos usuarios
    public function registrarUsuarioModel($usuario){
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        $contraseña = $usuario->getContraseña();

        $sql = "INSERT INTO Usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email','$contraseña')";
        $result = mysqli_query($this->db, $sql);

        return $result;
    }

    //Funcion para iniciar sesión

    public function iniciarSesionModel($email, $contraseña){
        $sql = "SELECT * FROM Usuarios WHERE email = '$email' AND contraseña = '$contraseña'";
        $resultado = mysqli_query($this->db, $sql);
        $usuario = mysqli_fetch_assoc($resultado);

        //var_dump($usuario);

        if($usuario){
            //Iniciar sesion de usuario
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['email'] = $usuario['email'];

            // Imprimir el usuario para ver su contenido
        echo "<pre>";
        print_r($usuario);
        echo "</pre>";
        
            return true; //Sesion iniciada correctamente
        }else{
            return false; //Error de inicio de sesión
        }
    }

    public function buscarUsuarioPorID($id){
        $sql = "SELECT * FROM Usuarios WHERE id_usuario= ?";
        $stmt = mysqli_prepare($this->db, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);

        return $usuario; //Devuelve todos los datos del usuario
    }

    Public function actualizarUsuarioModel ($id_usuario, $nombre, $email, $contraseña){
        
        if($contraseña !== null){ 

            $sql =  "UPDATE Usuarios SET nombre = ?, email = ?, contraseña = ? WHERE id_usuario= ?";
            $stmt =mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nombre, $email, $contraseña, $id_usuario);

        }else{

            $sql = "UPDATE Usuarios SET nombre = ?, email = ? WHERE id_usuario = ?";
            $stmt =mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id_usuario);
        }

        $resultado = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $resultado ? "Actualización exitosa." : "Error al actualizar el perfil.";
    }
}