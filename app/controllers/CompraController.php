<?php

require_once __DIR__ . '/../models/Compra.php';

class CompraController
{
    private $compra;

    public function __construct()
    {
        $this->compra = new Compra();
    }

    public function listar()
    {
        return $this->compra->listar();
    }

    public function obtenerProveedores()
    {
        return $this->compra->obtenerProveedores();
    }
    public function reporteComprasDetalladas()
    {
        return $this->compra->reporteComprasDetalladas();
    }
    public function reporteCompras()
    {
        return $this->compra->reporteCompras();
    }

    public function obtenerProductos()
    {
        return $this->compra->obtenerProductos();
    }

    public function guardar(
        $proveedor_id,
        $usuario_id,
        $factura,
        $archivoFactura,
        $productos,
        $total
    ) {
        return $this->compra->guardar(
            $proveedor_id,
            $usuario_id,
            $factura,
            $archivoFactura,
            $productos,
            $total
        );
    }
    public function anular($id)
    {
        return $this->compra->anular($id);
    }
    public function actualizarComprobante(
        $id,
        $archivo
    ) {
        return $this->compra->actualizarComprobante(
            $id,
            $archivo
        );
    }
}