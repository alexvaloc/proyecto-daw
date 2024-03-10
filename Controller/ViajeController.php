<?php

require_once __DIR__ . '/../entities/Viaje.php';
require_once __DIR__ . '/../model/ViajeModel.php';

class ViajeController{
    private $viajeModel;

    public function __construct(){
        $this->viajeModel = new ViajeModel();
        
    }

    public function crearViajeController(Viaje $viaje){
        return $this->viajeModel->crearViajeModel($viaje);
    }

    public function obtenerViajesPorUsuarioController($idUsuario){
        return $this->viajeModel->obtenerViajesPorUsuarioModel($idUsuario);
    }
}