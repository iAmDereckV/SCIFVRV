<?php

require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
    }

    public function listar()
    {
        return $this->categoria->listar();
    }

    public function guardar($nombre, $descripcion)
    {
        return $this->categoria->guardar(
            $nombre,
            $descripcion
        );
    }

    public function obtenerPorId($id)
    {
        return $this->categoria->obtenerPorId($id);
    }

    public function actualizar($id, $nombre, $descripcion)
    {
        return $this->categoria->actualizar(
            $id,
            $nombre,
            $descripcion
        );
    }

    public function cambiarEstado($id, $estado)
    {
        return $this->categoria->cambiarEstado(
            $id,
            $estado
        );
    }
}