<?php

require_once __DIR__ . '/../entities/Actividad.php';
require_once __DIR__ . '/../model/ActividadModel.php';

class ActividadController {
    private $actividadModel;

    public function __construct() {
        $this->actividadModel = new ActividadModel();
    }

    public function crearActividadController(Actividad $actividad) {
        return $this->actividadModel->crearActividadModel($actividad);
    }

    public function obtenerActividadesPorDestinoController($idActividad) {
        
        return $this->actividadModel->obtenerActividadesPorDestinoModel($idActividad);
    }

    public function obtenerActividadPorIdController($idActividad) {
        return $this->actividadModel->obtenerActividadPorIdModel($idActividad);
    }


    public function actualizarActividadController(Actividad $actividad) {
        return $this->actividadModel->actualizarActividadModel($actividad);
    }

    public function eliminarActividadController($idDestino,$idActividad) {
        return $this->actividadModel->eliminarActividadModel($idDestino, $idActividad);
    }

    public function calcularTotalPrecioPorDestinoController($idDestino) {
        return $this->actividadModel->calcularTotalPrecioPorDestinoModel($idDestino);
    }
}