<?php

require_once __DIR__ . '/Conexion.php';

class ViajeModel {

    private $db;

    public function __construct(){
        $this->db = crearConexion();
    }

    //Nuestra funcion crearViaje espera un objeto Viaje
    public function crearViajeModel(Viaje $viaje){
        $sql = "INSERT INTO Viajes (nombre_viaje, fecha_inicio, fecha_fin,presupuesto_total,id_usuario)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        //Recogemos los datos del objeto viaje mediante sus getters
        $nombreViaje = $viaje->getNombreViaje();
        $fechaInicio = $viaje->getFechaInicio();
        $fechaFin = $viaje->getFechaFin();
        $presupuestoTotal = $viaje->getPresupuestoTotal();
        $idUsuario = $viaje->getIdUsuario();

        $stmt->bind_param("sssdi",
            $nombreViaje,
            $fechaInicio,
            $fechaFin,
            $presupuestoTotal,
            $idUsuario    
        );
    
        if($stmt->execute()){
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }

    public function obtenerViajesPorUsuarioModel($idUsuario){
        $viajes = [];

        //Concretamos la consulta SQL
        $sql = "SELECT * FROM Viajes Where id_usuario = ? ORDER BY fecha_inicio DESC";

        $stmt = $this->db->prepare($sql);

        if($stmt){
            //Vinculamos los parámetros con los marcadores
            $stmt->bind_param("i",$idUsuario);

            //Ejecutamos la consulta
            if($stmt->execute()){

                //Obtenemos los resultados
                $resultado = $stmt->get_result();

                //Fetch de todos los viajes
                while($fila = $resultado->fetch_assoc()){
                    $viajes[] = $fila;
                }

            }

            $stmt->close();
        }
        
        return $viajes;
    }

    public function obtenerViajePorIdModel($idViaje){
        $sql = "SELECT * FROM Viajes WHERE id_viaje = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $idViaje);
            $stmt->execute();
            $resultado = $stmt->get_result();

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

    public function actualizarViajeModel(Viaje $viaje){
        //preparamos la consulta SQL
        $sql = "UPDATE Viajes 
                SET nombre_viaje = ?, fecha_inicio = ?, fecha_fin = ?, presupuesto_total = ?, 
                WHERE id_viaje = ? AND id_usuario = ?";

        $stmt = $this->db->prepare($sql);
        //Recogemos los datos del objeto viaje mediante sus getters
        $nombreViaje = $viaje->getNombreViaje();
        $fechaInicio = $viaje->getFechaInicio();
        $fechaFin = $viaje->getFechaFin();
        $presupuestoTotal = $viaje->getPresupuestoTotal();
        $idUsuario = $viaje->getIdUsuario();
        $idViaje = $viaje->getIdUsuario();

         $stmt->bind_param("sssdi",
            $nombreViaje,
            $fechaInicio,
            $fechaFin,
            $presupuestoTotal,
            $idUsuario,
            $idViaje
        );

        if($resultado = $stmt->execute()){
            $stmt->close();
            return $resultado;
        }else{
            return false;
        }
    }

    public function eliminarViajeModel($idViaje, $idUsuario){

        //preparamos la consulta SQL
        $sql = "DELETE FROM Viajes WHERE id_viaje = ? AND id_usuario = ?";

        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("ii", $idViaje, $idUsuario);
            $resultado= $stmt->execute();
            $stmt->close();
            return $resultado;
        } else { 
            return false;
        }
    }

}