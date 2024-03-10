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
        $this->nombre_destino = $nombre_destino;
    }

    public function getFechaInicio(){
        return $this->fecha_inicio;
    }

    public function setFechaInicio($fecha_inicio){
        $this->fecha_inicio = $fecha_inicio;
    }

    public function getFechaFin(){
        return $this->fecha_fin;
    }

    public function setFechaFin($fecha_fin){
        $this->fecha_fin = $fecha_fin;
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