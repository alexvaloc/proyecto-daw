<?php

//Clase Destino
class Destino {
    private $id_destino;
    private $nombre_destino;
    private $fecha_inicio;
    private $fecha_fin;
    private $id_viaje;
    private $actividades = []; //Array para almacenar objetos Actividad relacionados con el destino

    //Setters y getters

    public function getIdDestino(){
        return $this->id_destino;
    }

    public function setIdDestino($id_destino){
        $this->id_destino = $id_destino;
    }

    public function getNombreDestino(){
        return $this->nombre_destino;;
    }

    public function setNombreDestino($nombre_destino){
        if(empty($nombre_destino)){
            throw new Exception("El nombre del destino no puede estar vacío");
        }
        $this->nombre_destino = $nombre_destino;
    }

    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio){
         //Validación del formato de la fecha
         $date = DateTime::createFromFormat('Y-m-d', $fecha_inicio);
         if($date && $date->format('Y-m-d') === $fecha_inicio){
         $this->fecha_inicio = $fecha_inicio;
         }else{
             throw new Exception("La fecha de inicio no es válida");
         }
    }

    public function getFechaFin(){
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin){
        //Validación de que la fecha final debe ser posterior a la inicial
        $fechaInicio = DateTime::createFromFormat('Y-m-d', $this->fecha_inicio);
        $fechaFin = DateTime::createFromFormat('Y-m-d', $fecha_fin);

        if($fechaFin && $fechaFin->format('Y-m-d') === $fecha_fin){
            if($fechaInicio <= $fechaFin){
                $this->fecha_fin = $fecha_fin;
            }else{
                throw new Exception ("La fecha de fin debe ser posterior a la fecha de inicio");
            }
        }
    }


    public function getIdViaje(){
        return $this->id_viaje;
    }
    
    public function setIdViaje($id_viaje){
        $this->id_viaje = $id_viaje;
    }

    public function setActividad(Actividad $actividad){
        $this->actividades[] = $actividad;
    }

    public function getActividades(){
        return $this->actividades;
    }
}