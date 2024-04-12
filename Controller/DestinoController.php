<?php
//Dependencias
require_once __DIR__ . '/../entities/Destino.php';
require_once __DIR__ . '/../model/DestinoModel.php';

//Clase DestinoController
class DestinoController{
    
    private $destinoModel;

    //Controlador
    public function __construct(){
        $this->destinoModel = new DestinoModel();  
    }

    //Función que llama a la función crearDestinoModel
    public function crearDestinoController(Destino $destino){
        return $this->destinoModel->crearDestinoModel($destino);
    }

    //Función que llama a la función actualizarrDestinoModel
    public function actualizarDestinoController(Destino $destino){
        return $this->destinoModel->actualizarDestinoModel($destino);
    }

    //Función que llama a la función eliminarDestinoModel
    public function eliminarDestinoController($idDestino){
        return $this->destinoModel->eliminarDestinoModel($idDestino);
    }

    //Función que llama a la función obtenerDestinoporIdModel
    public function obtenerDestinoPorIdController($idDestino){
        return $this->destinoModel->obtenerDestinoPorIdModel($idDestino);
    }

    //Función que llama a la función obtenerDestinoPorViajeModel
    public function obtenerDestinosPorViajeController($idViaje){
        return $this->destinoModel->obtenerDestinosPorViajeModel($idViaje);
    }

}