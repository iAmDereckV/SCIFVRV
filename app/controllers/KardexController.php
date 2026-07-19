<?php

require_once __DIR__ . '/../models/Kardex.php';

class KardexController
{
    private $model;

    public function __construct()
    {
        $this->model = new Kardex();
    }

    public function consultar($producto_id)
    {
        return $this->model->consultar($producto_id);
    }
    public function obtenerProducto($id)
    {
        return $this->model->obtenerProducto($id);
    }
}