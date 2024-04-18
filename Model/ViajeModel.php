<?php
//Dependencias
require_once __DIR__ . '/Conexion.php';

//Clase ViajeModel
class ViajeModel {
    //Variables
    private $db;
    //Constructor de l clase
    public function __construct(){
        $this->db = crearConexion();
    }

    //Nuestra funcion crearViaje espera un objeto Viaje
    public function crearViajeModel(Viaje $viaje){
        //Sentencia SQL para la creación del viaje
        $sql = "INSERT INTO Viajes (nombre_viaje, fecha_inicio, fecha_fin,presupuesto_total,id_usuario)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        //Recogemos los datos del objeto viaje mediante sus getters
        $nombreViaje = $viaje->getNombreViaje();
        $fechaInicio = $viaje->getFechaInicio();
        $fechaFin = $viaje->getFechaFin();
        $presupuestoTotal = $viaje->getPresupuestoTotal();
        $idUsuario = $viaje->getIdUsuario();

        //Enlazamos los parámetros a la sentencia SQL
        $stmt->bind_param("sssdi",
            $nombreViaje,
            $fechaInicio,
            $fechaFin,
            $presupuestoTotal,
            $idUsuario    
        );
        
        //Ejecutamos la sentencia SQL, devuelve True en caso de éxito o false en caso de error
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    //Función para identificar los viajes de un usuario
    public function obtenerViajesPorUsuarioModel($idUsuario){
        $viajes = [];

        //Concretamos la consulta SQL
        $sql = "SELECT * FROM Viajes Where id_usuario = ? ORDER BY fecha_inicio ASC";

        $stmt = $this->db->prepare($sql);

        if($stmt){
            //Vinculamos los parámetros con los marcadores
            $stmt->bind_param("i",$idUsuario);

            //Ejecutamos la consulta
            if($stmt->execute()){

                //Obtenemos los resultados
                $resultado = $stmt->get_result();

                //Recorre los viajes y los guarda en un array
                while($fila = $resultado->fetch_assoc()){
                    $viajes[] = $fila;
                }

            }

            $stmt->close();
        }
        
        //Devuelve un array con los viajes del usuario
        return $viajes;
    }

    //Función para idenfiticar un viaje por ID
    public function obtenerViajePorIdModel($idViaje){

        //Sentencia SQL
        $sql = "SELECT * FROM Viajes WHERE id_viaje = ?";

        
        //Preparamos la sentencia
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idViaje);
            $stmt->execute();
            $resultado = $stmt->get_result();
            //Recorremos los viajes 
            if($viaje = $resultado->fetch_assoc()){
                $stmt->close();
                return $viaje;
            }else{
                $stmt->close();
                return null; //No se encontró viaje
            }
        }else{
            return null; //Error en la preparación de la consulta
        }
    }

    //Función para actualizar datos del viaje
    public function actualizarViajeModel(Viaje $viaje){

        //Sentencia SQL
        $sql = "UPDATE Viajes SET nombre_viaje = ?, fecha_inicio = ?, fecha_fin = ?, presupuesto_total = ? WHERE id_viaje = ? AND id_usuario = ?";
        if($stmt = $this->db->prepare($sql)){
           
            //Obtenemos los parámetros
            $stmt->bind_param("sssdii", 
                $viaje->getNombreViaje(),
                $viaje->getFechaInicio(),
                $viaje->getFechaFin(),
                $viaje->getPresupuestoTotal(),
                $viaje->getIdViaje(),
                $viaje->getIdUsuario()
            );
            //Ejecutamos la sentencia
            $resultado = $stmt->execute();
            $stmt->close();
            
            if($resultado){
                return true; // La actualización fue exitosa
            } else {
                error_log("Error al actualizar el viaje: " . $stmt->error);
                return false; // La actualización falló
            }
        } else {
            error_log("Error preparando la consulta: " . $this->db->error);
            return false; // Error preparando la consulta
        }
    }

    //Función para eliminar un viaje
    public function eliminarViajeModel($idViaje, $idUsuario){

        //preparamos la consulta SQL
        $sql = "DELETE FROM Viajes WHERE id_viaje = ? AND id_usuario = ?";

        //Preparamos la consulta
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("ii", $idViaje, $idUsuario);
            //Ejecutamos la consulta
            $resultado= $stmt->execute();
            $stmt->close();
            //Si tiene éxito devolvemos $resultado
            return $resultado;
        } else { 
            return false;
        }
    }

    //Función para actualizar la imágen del viaje
    public function actualizarImagenModel($idViaje, $nombreImagen){
        $sql = "UPDATE Viajes SET ruta_imagen = ? WHERE id_viaje = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("si", $nombreImagen, $idViaje);
            $stmt->execute();
            $affectedRows = $stmt->affected_rows> 0;

            $stmt->close();
            return $affectedRows > 0;            
        }else{
            return false;
        }
    }

}