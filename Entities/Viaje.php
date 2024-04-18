<?php

//Clase para crear objetos viaje

class Viaje {

    //Variables privadas de clase
    private $id_viaje;
    private $nombre_viaje;
    private $fecha_inicio;
    private $fecha_fin;
    private $presupuesto_total;
    private $id_usuario;
    private $destinos = []; //Array para recolectar los diferentes destinos que pueden estar asociados a Viaje
    private $rutaImagen;

    //Constructor de la clase
    public function __construct($nombre_viaje= '',$fecha_inicio = '0000-00-00',$fecha_fin  = '0000-00-00' ,$presupuesto_total = 0,$id_usuario = null, $id_viaje = null, $rutaImagen= ''){
        
        $this->id_viaje = $id_viaje;
        $this->nombre_viaje = $nombre_viaje;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->presupuesto_total = $presupuesto_total;
        $this->id_usuario = $id_usuario;
        $this->rutaImagen = $rutaImagen;
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
        //Validamos el tipo de la variable y que no sea un campo vacío
        if(!empty($nombre_viaje) && is_string($nombre_viaje)){
        $this->nombre_viaje = $nombre_viaje;
        }else{
            throw new Exception("El nombre del viaje no puede estar vacío y solo puede contener carácteres alfanuméricos");
        }
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

    public function getPresupuestoTotal(){
        return $this->presupuesto_total;
    }

    public function setPresupuestoTotal($presupuesto_total){
        if(is_numeric($presupuesto_total) && $presupuesto_total >=0) {
        $this->presupuesto_total = $presupuesto_total;
        }else{
            throw new Exception ("El presupuesto debe ser un número mayor a 0");
        }
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

    public function getRutaimagen(){
        return $this->rutaImagen;
    }

    public function setRutaImagen($rutaImagen){
        $this->rutaImagen = $rutaImagen;
    }
}

