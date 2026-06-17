<?php

require_once __DIR__ . '/../models/Marca.php';

class MarcaController
{
    private $marca;

    public function __construct()
    {
        $this->marca = new Marca();
    }

    public function listar()
    {
        return $this->marca->listar();
    }

    public function guardar(
        $nombre,
        $descripcion
    ) {
        return $this->marca->guardar(
            $nombre,
            $descripcion
        );
    }

    public function obtenerPorId($id)
    {
        return $this->marca->obtenerPorId($id);
    }

    public function actualizar(
        $id,
        $nombre,
        $descripcion
    ) {
        return $this->marca->actualizar(
            $id,
            $nombre,
            $descripcion
        );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->marca->cambiarEstado(
            $id,
            $estado
        );
    }
}
