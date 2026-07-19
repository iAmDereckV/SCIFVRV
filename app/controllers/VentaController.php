<?php

require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/DetalleVenta.php';

class VentaController
{
    private $venta;
    private $detalleventa;


    public function __construct()
    {
        $this->venta = new Venta();
        $this->detalleventa = new DetalleVenta();
    }

    public function clientes()
    {
        return $this->venta->obtenerClientes();
    }
    public function reporteVentas()
    {
        return $this->venta->reporteVentas();
    }
    public function reporteVentasDetalladas()
    {
        return $this->venta->reporteVentasDetalladas();
    }

    public function productos()
    {
        return $this->venta->obtenerProductos();
    }

    public function listar()
    {
        return $this->venta->listarVentas();
    }
    public function guardar(
        $cliente_id,
        $usuario_id,
        $subtotal,
        $impuesto,
        $descuento,
        $total,
        $detalle,
    ) {
        return $this->venta->guardarVenta(
            $cliente_id,
            $usuario_id,
            $subtotal,
            $impuesto,
            $descuento,
            $total,
            $detalle,
        );
    }
    public function obtenerVenta($id)
    {
        return $this->detalleventa->obtenerVenta($id);
    }

    public function obtenerDetalleVenta($venta_id)
    {
        return $this->detalleventa->obtenerDetalleVenta($venta_id);
    }
    public function obtenerFactura($id)
    {
        return $this->detalleventa->obtenerFactura($id);
    }
    public function obtenerDetalleFactura($id)
    {
        return $this->detalleventa->obtenerDetalleFactura($id);
    }
    public function anular($id)
    {
        return $this->venta->anular($id);
    }
}