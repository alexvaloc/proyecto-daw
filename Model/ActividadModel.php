<?php

class ActividadModel {
    private $db;

    public function __construct() {
        $this->db = crearConexion();
    }

    public function crearActividadModel(Actividad $actividad) {
        // Implementa la lógica para insertar una actividad en la base de datos
    }

    public function obtenerActividadesPorDestinoModel($id_destino) {
        // Implementa la lógica para obtener todas las actividades de un destino
    }

    public function obtenerActividadPorIdModel($id_actividad) {
        // Implementa la lógica para obtener todas las actividades de un destino
    }

    public function actualizarActividadModel(Actividad $actividad) {
        // Implementa la lógica para actualizar una actividad existente
    }

    public function eliminarActividadModel($id_actividad) {
        // Implementa la lógica para eliminar una actividad
    }
}