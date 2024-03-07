<?php

require_once "Conexion.php";

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

            // Imprimir el usuario para ver su contenido
        echo "<pre>";
        print_r($usuario);
        echo "</pre>";
        
            return true; //Sesion iniciada correctamente
        }else{
            return false; //Error de inicio de sesión
        }
    }
}