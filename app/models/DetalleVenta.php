<?php

require_once __DIR__ . '/../config/database.php';

class DetalleVenta
{
    private $conexion;
    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function obtenerVenta($id)
    {
        $sql = "SELECT v.*,c.nombres,c.apellidos,c.telefono,u.nombre AS vendedor
            FROM ventas v
            INNER JOIN clientes c ON c.id = v.cliente_id
            INNER JOIN usuarios u ON u.id = v.usuario_id
            WHERE v.id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function obtenerDetalleVenta($venta_id)
    {
        $sql = "SELECT d.*,p.codigo,p.nombre
            FROM detalle_ventas d
            INNER JOIN productos p ON p.id = d.producto_id
            WHERE d.venta_id = :venta_id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':venta_id' => $venta_id]);
        return $stmt->fetchAll();
    }
    public function obtenerFactura($venta_id)
    {
        $sql = "SELECT v.*, CONCAT(c.nombres, ' ', c.apellidos) cliente, c.telefono, u.nombre usuario, u.correo
            FROM ventas v
            INNER JOIN clientes c ON c.id = v.cliente_id
            INNER JOIN usuarios u ON u.id = v.usuario_id
            WHERE v.id =  ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$venta_id]);
        return $stmt->fetch();
    }
    public function obtenerDetalleFactura($venta_id)
    {
        $sql = "SELECT dv.cantidad,dv.precio_unitario,dv.subtotal,p.codigo,p.nombre producto
        FROM detalle_ventas dv
        INNER JOIN productos p ON p.id = dv.producto_id
        WHERE dv.venta_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$venta_id]);
        return $stmt->fetchAll();
    }
}