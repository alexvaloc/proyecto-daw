<?php

class ActividadController {
    private $actividadModel;

    public function __construct() {
        $this->actividadModel = new ActividadModel();
    }

    public function crearActividadController(Actividad $actividad) {
        // Llama al modelo para crear una actividad
    }

    public function obtenerActividadesPorDestinoController($id_destino) {
        // Llama al modelo para obtener actividades por destino
    }

    public function obtenerActividadPorIdController($id_actividad) {
        // Implementa la lógica para obtener todas las actividades de un destino
    }


    public function actualizarActividadController(Actividad $actividad) {
        // Llama al modelo para actualizar una actividad
    }

    public function eliminarActividadController($id_actividad) {
        // Llama al modelo para eliminar una actividad
    }
}