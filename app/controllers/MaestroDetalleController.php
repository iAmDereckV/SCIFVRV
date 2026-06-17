<?php

require_once __DIR__ . '/../models/MaestroDetalle.php';

class MaestroDetalleController
{
    private $model;

    public function __construct()
    {
        $this->model = new MaestroDetalle();
    }

    public function obtenerResumen($anio)
    {
        return $this->model->obtenerResumen($anio);
    }
    public function obtenerAnios()
    {
        return $this->model->obtenerAnios();
    }
}