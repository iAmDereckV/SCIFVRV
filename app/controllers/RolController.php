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
    public function obtenerPermisos($rol_id)
    {
        return $this->rol
            ->obtenerPermisos(
                $rol_id
            );
    }
    public function guardarPermisos(
        $rol_id,
        $permisos
    ) {
        return $this->rol
            ->guardarPermisos(
                $rol_id,
                $permisos
            );
    }
    public function obtenerPorId($id)
    {
        return $this->rol->obtenerPorId($id);
    }
}
