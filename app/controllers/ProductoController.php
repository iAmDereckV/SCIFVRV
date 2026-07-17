<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function listar()
    {
        return $this->producto->listar();
    }

    public function categorias()
    {
        return $this->producto->obtenerCategorias();
    }

    public function marcas()
    {
        return $this->producto->obtenerMarcas();
    }
    public function actualizarImagen(
        $id,
        $imagen
    ) {
        return $this->producto->actualizarImagen(
            $id,
            $imagen
        );
    }

    public function guardar(
        $codigo,
        $categoria_id,
        $marca_id,
        $nombre,
        $descripcion,
        $vehiculo_aplicable,
        $precio_compra,
        $precio_venta,
        $stock,
        $stock_minimo,
        $ubicacion,
        $nombreImagen
    ) {
        return $this->producto->guardar(
            $codigo,
            $categoria_id,
            $marca_id,
            $nombre,
            $descripcion,
            $vehiculo_aplicable,
            $precio_compra,
            $precio_venta,
            $stock,
            $stock_minimo,
            $ubicacion,
            $nombreImagen
        );
    }

    public function obtenerPorId($id)
    {
        return $this->producto->obtenerPorId($id);
    }
    public function obtenerDetalle($id)
    {
        return $this->producto->obtenerDetalle($id);
    }
    public function actualizar(
        $id,
        $codigo,
        $categoria_id,
        $marca_id,
        $nombre,
        $descripcion,
        $vehiculo_aplicable,
        $precio_compra,
        $precio_venta,
        $stock,
        $stock_minimo,
        $ubicacion
    ) {
        return $this->producto->actualizar(
            $id,
            $codigo,
            $categoria_id,
            $marca_id,
            $nombre,
            $descripcion,
            $vehiculo_aplicable,
            $precio_compra,
            $precio_venta,
            $stock,
            $stock_minimo,
            $ubicacion
        );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->producto->cambiarEstado(
            $id,
            $estado
        );
    }
}
