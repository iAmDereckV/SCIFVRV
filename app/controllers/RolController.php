<?php

require_once __DIR__ . '/../models/Rol.php';

class RolController
{
    private $rol;

    public function __construct()
    {
        $this->rol = new Rol();
    }

    public function listar()
    {
        return $this->rol->listar();
    }

    public function guardar(
        $nombre,
        $descripcion
    ) {
        return $this->rol->guardar(
            $nombre,
            $descripcion
        );
    }

    public function actualizar(
        $id,
        $nombre,
        $descripcion
    ) {
        return $this->rol->actualizar(
            $id,
            $nombre,
            $descripcion
        );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->rol->cambiarEstado(
            $id,
            $estado
        );
    }
}
