<?php

require_once __DIR__ . '/../entities/Usuario.php';
require_once __DIR__ . '/../model/UsuarioModel.php';

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
        $resultadoInicioSesion =  $this->usuarioModel->iniciarSesionModel($email,$contraseña);
        
        if($resultadoInicioSesion){

        // Suponiendo que iniciarSesionModel ya ha establecido el ID del usuario en la sesión.
        // Ahora, obtenemos toda la información del usuario por su ID.
        $idUsuario = $_SESSION['id_usuario'];
        $datosUsuario = $this->usuarioModel->buscarUsuarioPorID($idUsuario);

        // Actualizamos la sesión con la información completa del usuario
        $_SESSION['nombre'] = $datosUsuario['nombre'];
        $_SESSION['email'] = $datosUsuario['email'];
        //No agregamos la contraseña por razones de seguridad

        return true; // Inicio de sesión y actualización de sesión exitosos.

        } else {
            return false; // Fallo en el inicio de sesión.
        }
    }


    //Función para cerrar sesión
    public function cerrarSesion(){
        
        session_destroy();

        return "Su sesión se ha cerrado con éxito.";
    }

    //Funcion para editar perfil

    public function actualizarUsuarioController($id_usuario,$nombre,$email,$contraseña,$confirmar_contraseña){
        //Validación básica de la contraseña
        if (!empty($contraseña) || !empty($confirmar_contraseña)) {
            if ($contraseña !== $confirmar_contraseña) {
                return "Las contraseñas no coinciden.";
            }else{
                $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            }
        } else {
            // Mantén la contraseña actual si no se proporciona una nueva
            $contraseña = null;
        }

        // Llama al modelo para actualizar los datos del usuario, incluida la nueva contraseña si se proporciona
        $resultado = $this->usuarioModel->actualizarUsuarioModel($id_usuario, $nombre, $email, $contraseña);
        //Devuelve true o mensaje de error
        return $resultado ? true : "Error al actualizar el perfil.";
    }
 }