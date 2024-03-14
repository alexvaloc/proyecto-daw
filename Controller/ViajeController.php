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

    public function obtenerViajeporIdController($idViaje){
        return $this->viajeModel->obtenerViajePorIdModel($idViaje);
    }

    public function actualizarViajeController(Viaje $viaje) {
        return $this->viajeModel->actualizarViajeModel($viaje);
    }

    public function eliminarViajeController($idViaje, $idUsuario) {
        return $this->viajeModel->eliminarViajeModel($idViaje, $idUsuario);
    }

    public function actualizarImagenViajeController($idViaje, $nombreImagen){
        return $this->viajeModel->actualizarImagenModel($idViaje, $nombreImagen);
    }
}