<?php

require_once "../Model/UsuarioModel.php";
require_once "./Usuario.php";

//Clase UsuarioController
class UsuarioController{

    private $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }

    //Función para registrar un nuevo usuario
    public function registrarUsuarioController($nombre,$email,$contraseña){
        $usuario = new Usuario(null,$nombre,$email,$contraseña);
        return $this->usuarioModel->registrarUsuarioModel($usuario);
    }

    //Funcion para iniciar sesión
    public function iniciarSesionController($email,$contraseña){
        return $this->usuarioModel->iniciarSesionModel($email,$contraseña);
        
    }

    //Función para cerrar sesión
    public function cerrarSesion(){
        
        session_destroy();

        return "Su sesión se ha cerrado con éxito.";
    }
 }