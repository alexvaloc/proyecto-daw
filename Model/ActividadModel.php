<?php

require_once __DIR__ . '/Conexion.php';

class ActividadModel {
    private $db;

    public function __construct() {
        $this->db = crearConexion();
    }

    public function crearActividadModel(Actividad $actividad) {

        //Definimos la consulta
        $sql = "INSERT INTO Actividades (nombre_actividad, descripcion, fecha, duracion, precio, id_destino)
                VALUES (?, ?, ?, ?, ?, ?)";

        //Preparamos la consulta
        $stmt = $this->db->prepare($sql);

        //Recogemos los datos del objeto Destino mediante sus getters
        $stmt->bind_param("ssssdi", 
        $actividad->getNombreActividad(), 
        $actividad->getDescripcion(), 
        $actividad->getFecha(), 
        $actividad->getDuracion(), 
        $actividad->getPrecio(), 
        $actividad->getIdDestino());

        if($stmt->execute()){
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function obtenerActividadesPorDestinoModel($idDestino) {
        //Definimos la consulta
        $sql = "SELECT * FROM Actividades WHERE id_destino = ?";
        //Creamos un array donde meter nuestras actividades
        $actividades = [];
        //Preparamos al consulta
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idDestino);
            
            //Ejecutamos la consulta
            if($stmt->execute()){
                $resultado = $stmt->get_result();
                while($fila = $resultado->fetch_assoc()){
                    $actividades[] = $fila;
                }
                $stmt->close();
                return $actividades;
            }else{
                $stmt->close();
                return false; //Error en la ejecución de la consulta
            }
        }else{
            return false; //Error preparando la consulta
        }
    }

    public function obtenerActividadPorIdModel($idActividad) {
        $sql = "SELECT * FROM Actividades WHERE id_actividad = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idActividad);
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

    public function actualizarActividadModel(Actividad $actividad) {
        //Definimos la consulta SQL
        $sql = "UPDATE Actividades SET nombre_actividad = ?, descripcion = ?, fecha = ?, duracion = ?, precio = ? 
                 WHERE id_actividad = ? AND id_destino = ?";
        //Preparamos la consulta
            $stmt = $this->db->prepare($sql);

        if(!$stmt){
            return false; // O manejar el error específico
        }

        // Asignamos el valor del objeto a las variables
            $nombreActividad = $actividad->getNombreActividad();
            $descripcion = $actividad->getDescripcion();
            $fecha = $actividad->getFecha();
            $duracion = $actividad->getDuracion();
            $precio = $actividad->getPrecio();
            $idActividad = $actividad->getIdActividad();
            $idDestino = $actividad->getIdDestino();

        // Enlazamos los valores
            $stmt->bind_param("ssssdii", 
            $nombreActividad, 
            $descripcion, 
            $fecha, 
            $duracion,
            $precio, 
            $idActividad, 
            $idDestino);

        // Ejecutamos la consulta
        if($stmt->execute()){
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false; // O manejar el error específico
        }
    }

    public function eliminarActividadModel($idDestino, $idActividad) {
        //Definimos la consulta
        $sql = "DELETE FROM Actividades WHERE id_actividad = ? AND id_destino = ?";
        //Preparamos la consulta
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("ii", $idActividad, $idDestino);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        }else{
            return false;
        }
    }

}