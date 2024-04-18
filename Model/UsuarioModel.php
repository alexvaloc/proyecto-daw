<?php
//Dependencias
require_once __DIR__ . '/Conexion.php';

//Clase UsuarioModel
class UsuarioModel{
    //Variavles
    private $db;

    //creamos la conexión 
    public function __construct(){
        $this->db= crearConexion();
    }

    //Funcion para registrar nuevos usuarios
    public function registrarUsuarioModel($usuario){
        $nombre = $usuario->getNombre();
        $email = $usuario->getEmail();
        //Encriptamos la contraseña
        $contraseña = password_hash($usuario->getContraseña(), PASSWORD_DEFAULT);
        //Sentencia SQL
        $sql = "INSERT INTO Usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
            //Preparamos la sentencia
            $stmt = mysqli_prepare($this->db, $sql);
            if (false === $stmt) {
                // Error al preparar la sentencia
                throw new Exception("Error al preparar la sentencia: " . mysqli_error($this->db));
            }

            $resultado = mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $contraseña);
            if (false === $resultado) {
                // Error al vincular parámetros
                throw new Exception("Error al vincular parámetros: " . mysqli_stmt_error($stmt));
            }

            $resultado = mysqli_stmt_execute($stmt);
            if (false === $resultado) {
                // Error al ejecutar la sentencia
                throw new Exception("Error al ejecutar la sentencia: " . mysqli_stmt_error($stmt));
            }
            //Cerramos la conexión
            mysqli_stmt_close($stmt);
        return $resultado;
    }

    //Funcion para iniciar sesión

    public function iniciarSesionModel($email, $contraseña){
        //Preparamos la consulta 
        $sql = "SELECT * FROM Usuarios WHERE email = '$email'";
        //Ejecutamos la consulta
        $resultado = mysqli_query($this->db, $sql);
        //Recojemos los resultados
        $usuario = mysqli_fetch_assoc($resultado);

        //var_dump($usuario); Prueba de debuggin

        //Desencriptamos la contraseña, si coincide se guardan los datos del usuario en la sesion
        if($usuario && password_verify($contraseña, $usuario['contraseña'])){
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

    // Funcion de buscar usuario
    public function buscarUsuarioPorID($id){
        //Consulta
        $sql = "SELECT * FROM Usuarios WHERE id_usuario= ?";
        //Preparamos la consulta
        $stmt = mysqli_prepare($this->db, $sql);
        //Asignamos los valores
        mysqli_stmt_bind_param($stmt, "i", $id);
        //Ejecutamos la consulta
        mysqli_stmt_execute($stmt);
        //Recojemos los resultados
        $resultado = mysqli_stmt_get_result($stmt);
        $usuario = mysqli_fetch_assoc($resultado);

        return $usuario; //Devuelve todos los datos del usuario
    }

    //Función para actualizar los datos del usuario
    Public function actualizarUsuarioModel ($id_usuario, $nombre, $email, $contraseña){
        
        //Si la contraseña no es un campo vacio
        if($contraseña !== null){ 
            //Sentencia SQL para actualizar contraseña
            $sql =  "UPDATE Usuarios SET nombre = ?, email = ?, contraseña = ? WHERE id_usuario= ?";
            $stmt =mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nombre, $email, $contraseña, $id_usuario);

        }else{
            //Sentencia SQL para actualizar nombre y email
            $sql = "UPDATE Usuarios SET nombre = ?, email = ? WHERE id_usuario = ?";
            $stmt =mysqli_prepare($this->db, $sql);
            mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id_usuario);
        }

        $resultado = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        //Mensaje de éxito/error
        return $resultado ? "Actualización exitosa." : "Error al actualizar el perfil.";
    }
}