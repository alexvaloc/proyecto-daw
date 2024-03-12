<?php

require_once __DIR__ . '/Conexion.php';

class DestinoModel{
    private $db;

    public function __construct(){
        $this->db = crearConexion();
    }

    public function crearDestinoModel(Destino $destino){
        $sql = "INSERT INTO Destinos (nombre_destino, fecha_inicio, fecha_fin, id_viaje)
                VALUES (?,?,?,?)";

        $stmt = $this->db->prepare($sql);

        //Recogemos los datos edl objeto Destino mediante sus getters
        $nombreDestino = $destino->getNombreDestino();
        $fechaInicio = $destino->getFechaInicio();
        $fechaFin = $destino->getFechaFin();
        $idViaje = $destino->getIdViaje();

        $stmt->bind_param("sssi",
            $nombreDestino,
            $fechaInicio,
            $fechaFin,
            $idViaje
        );

        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    public function obtenerDestinoPorIdModel($idDestino){
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
                error_log("Error al actualizar el viaje: " . $stmt->error);
                return false; //la actualización falló
             }

        }else{
            error_log("Error preparando la consulta: " . $this->db->error);
            return false; //Error preparando la consulta
        }
    }

    public function eliminarDestinoModel($idDestino, $idViaje){
        $sql = "DELETE FROM Actividades WHERE id_destino = ? AND id_viaje = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("ii", $idDestino, $idViaje);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        }else{
            return false;
        }
    }
}

