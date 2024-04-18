<?php

//Clase para crear actividades

class Actividad{

    //Variables privadas de clase
    private $id_actividad;
    private $nombre_actividad;
    private $descrpicion;
    private $fecha;
    private $duracion;
    private $precio;
    private $id_destino;

    //Constructor de la clase
    public function __construct($nombre_actividad= '',$descripcion = '',$fecha = '0000-00-00' , $duracion = '', $precio = 0, $id_actividad = null,$id_destino = null){
        
        $this->id_actividad = $id_actividad;
        $this->nombre_actividad = $nombre_actividad;
        $this->descrpicion = $descripcion;
        $this->fecha = $fecha;
        $this->duracion = $duracion;
        $this->precio= $precio;
        $this->id_destino= $id_destino;
    }

    //Setters y getters

    public function getIdActividad(){
        return $this->id_actividad;
    }

    public function setIdActividad($id_actividad){
        $this->id_actividad = $id_actividad;
    }

    public function getNombreActividad(){
        return $this->nombre_actividad;
    }

    public function setNombreActividad($nombre_actividad){
        $this->nombre_actividad = $nombre_actividad;
    }

    public function getDescripcion(){
        return $this->descrpicion;
    }

    public function setDescripcion($descrpicion){
         $this->descrpicion = $descrpicion;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getDuracion(){
        return $this->duracion;
    }
    
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getIdDestino(){
        return $this->id_destino;
    }

    public function setIdDestino($id_destino){
        $this->id_destino = $id_destino;
    }
    
}