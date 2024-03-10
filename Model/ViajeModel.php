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

}