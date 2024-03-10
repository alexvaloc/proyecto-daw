<?php

//Clase para crear objetos viaje

class Viaje {
    private $id_viaje;
    private $nombre_viaje;
    private $fecha_inicio;
    private $fecha_fin;
    private $presupuesto_total;
    private $id_usuario;
    private $destinos = []; //Array para recolectar los diferentes destinos que pueden estar asociados a Viaje

    public function __construct($nombre_viaje,$fecha_inicio,$fecha_fin,$presupuesto_total,$id_usuario, $id_viaje = null){
        
        $this->id_viaje = $id_viaje;
        $this->nombre_viaje = $nombre_viaje;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->presupuesto_total = $presupuesto_total;
        $this->id_usuario = $id_usuario;
    }

    //Getters y Setters
    public function getIdViaje(){
        return $this->id_viaje;
    }

    public function setIdViaje($id_viaje){
        $this->id_viaje = $id_viaje;
    }

    public function getNombreViaje(){
        return $this->nombre_viaje;
    }

    public function setNombreViaje($nombre_viaje){
        $this->nombre_viaje = $nombre_viaje;
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

    public function getPresupuestoTotal(){
        return $this->presupuesto_total;
    }

    public function setPrespuestoTotal($presupuesto_total){
        $this->presupuesto_total = $presupuesto_total;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    }
    
    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getDestinos(){
        return $this->destinos;
    }

    public function setDestino(Destino $destino){
        $this->destinos[] = $destino;
    }
}

