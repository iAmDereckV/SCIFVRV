<?php

require_once __DIR__ .
    '/../models/ConfiguracionEmpresa.php';

class ConfiguracionEmpresaController
{
    private $model;

    public function __construct()
    {
        $this->model = new ConfiguracionEmpresa();
    }

    public function obtener()
    {
        return $this->model->obtener();
    }

    public function actualizar(
        $nombre,
        $ruc,
        $telefono,
        $correo,
        $direccion,
        $slogan,
        $logo,
    ) {
        return $this->model->actualizar(
            $nombre,
            $ruc,
            $telefono,
            $correo,
            $direccion,
            $slogan,
            $logo,
        );
    }
}