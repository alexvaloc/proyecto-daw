<?php

require_once __DIR__ . '/../entities/Destino.php';
require_once __DIR__ . '/../model/DestinoModel.php';

class DestinoController{
    
    private $destinoModel;

    public function __construct(){
        $this->destinoModel = new DestinoModel();  
    }

    public function crearDestinoController(Destino $destino){
        return $this->destinoModel->crearDestinoModel($destino);
    }

    public function actualizarDestinoController(Destino $destino){
        return $this->destinoModel->actualizarDestinoModel($destino);
    }

    public function eliminarDestinoController($idViaje,$idDestino){
        return $this->destinoModel->eliminarDestinoModel($idViaje,$idDestino);
    }

    public function obtenerDestinoPorIdController($idDestino){
        return $this->destinoModel->obtenerDestinoPorIdModel($idDestino);
    }

    public function obtenerDestinosPorViajeController($idViaje){
        return $this->destinoModel->obtenerDestinosPorViajeModel($idViaje);
    }

}