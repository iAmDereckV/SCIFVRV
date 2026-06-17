<?php

require_once __DIR__ . '/../models/Proveedor.php';

class ProveedorController
{
    private $proveedor;

    public function __construct()
    {
        $this->proveedor =
            new Proveedor();
    }

    public function listar()
    {
        return $this->proveedor->listar();
    }

    public function guardar(
        $nombre,
        $contacto,
        $telefono,
        $correo,
        $direccion
    ) {
        return $this->proveedor->guardar(
            $nombre,
            $contacto,
            $telefono,
            $correo,
            $direccion
        );
    }

    public function obtener($id)
    {
        return $this->proveedor
            ->obtener($id);
    }

    public function actualizar(
        $id,
        $nombre,
        $contacto,
        $telefono,
        $correo,
        $direccion
    ) {
        return $this->proveedor
            ->actualizar(
                $id,
                $nombre,
                $contacto,
                $telefono,
                $correo,
                $direccion
            );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->proveedor
            ->cambiarEstado(
                $id,
                $estado
            );
    }
}
