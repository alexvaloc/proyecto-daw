<?php
//Dependencias
require_once __DIR__ . '/Conexion.php';
//Clase DestinoModel
class DestinoModel{

    //Variables
    private $db;

    //Constructor
    public function __construct(){
        $this->db = crearConexion();
    }

    //Funcion para crear nuevos destinos, espera un objeto Destino
    public function crearDestinoModel(Destino $destino){

        //Sentencia SQL
        $sql = "INSERT INTO Destinos (nombre_destino, fecha_inicio, fecha_fin, id_viaje)
                VALUES (?,?,?,?)";

        $stmt = $this->db->prepare($sql);

        //Recogemos los datos edl objeto Destino mediante sus getters
        $nombreDestino = $destino->getNombreDestino();
        $fechaInicio = $destino->getFechaInicio();
        $fechaFin = $destino->getFechaFin();
        $idViaje = $destino->getIdViaje();

        //Asociamos las variables a la sentencia SQL
        $stmt->bind_param("sssi",
            $nombreDestino,
            $fechaInicio,
            $fechaFin,
            $idViaje
        );

        //Ejecutar la sentencia
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    //Funcion para buscar un Destino por ID
    public function obtenerDestinoPorIdModel($idDestino){
        //Sentencia SQL
        $sql = "SELECT * FROM Destinos WHERE id_destino = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idDestino);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($destino = $resultado->fetch_assoc()){
                $stmt->close();
                return $destino; //Devuelve el destino encontrado
            }else{
                return null; //No se encontró destino
            }
        }else{
            return null;//Error en la preparación de la consulta
        }
    }

    //Función para obtener todos los destinos de un Viaje
    public function obtenerDestinosPorViajeModel($idViaje){
        //Definimos la consulta
        $sql = "SELECT * FROM Destinos WHERE id_viaje = ? ORDER BY fecha_inicio ASC";
         //Creamos un array donde meter nuestros destinos
        $destinos = [];
        //Preparamos al consulta
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idViaje);

            //Ejecutamos la consulta
            if($stmt->execute()){
                $resultado = $stmt->get_result();
                while($fila = $resultado->fetch_assoc()){
                    $destinos[] = $fila;
                }
                $stmt->close();
                return $destinos;
            }else{
                $stmt->close();
                return false; //Error en la ejecución de la consulta
            }
        }else{
            return false; //Error preparando la consulta
        }
    }

    //Función para actualizar los datos de un destino
    public function actualizarDestinoModel(Destino $destino){
        //Definimos la consulta SQL
        $sql = "UPDATE Destinos SET nombre_destino = ?, fecha_inicio = ?, fecha_fin = ?
                WHERE id_destino = ? AND id_viaje = ?";
        //Preparamos la consulta
        if($stmt = $this->db->prepare($sql)){

            $stmt->bind_param("sssii",
            $destino->getNombreDestino(),
            $destino->getFechaInicio(),
            $destino->getFechaFin(),
            $destino->getIdDestino(),
            $destino->getIdViaje()
             );
             
             $resultado = $stmt->execute();
             $stmt->close();

             if($resultado){
                return true; //la actualización ha sido realizada con éxito
             }else{
                error_log("Error al actualizar el destino: " . $stmt->error);
                return false; //la actualización falló
             }

        }else{
            error_log("Error preparando la consulta: " . $this->db->error);
            return false; //Error preparando la consulta
        }
    }

    //Función para eliminar un Destino
    public function eliminarDestinoModel($idDestino){

        //Sentencia SQL
        $sql = "DELETE FROM Destinos WHERE id_destino = ?";
        //preparamos la sentencia
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idDestino);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        }else{
            return false;
        }
    }
}

