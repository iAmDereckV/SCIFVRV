<?php

require_once __DIR__ . '/../config/database.php';
class Bitacora
{
    private $conexion;
    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function listar()
    {
        $sql = "SELECT v.fecha,'VENTA' tipo,CONCAT('Factura #', v.id) referencia,CONCAT('Venta a ', c.nombres) descripcion,
            v.total entrada,0 salida,u.nombre usuario
            FROM ventas v
            INNER JOIN clientes c ON c.id = v.cliente_id
            INNER JOIN usuarios u ON u.id = v.usuario_id
            WHERE v.estado = 'COMPLETADA'
            UNION ALL
            SELECT c.fecha, 'COMPRA', CONCAT('Compra #', c.id), CONCAT('Compra a ', p.nombre), 0, c.total, u.nombre
            FROM compras c
            INNER JOIN proveedores p ON p.id = c.proveedor_id
            INNER JOIN usuarios u ON u.id = c.usuario_id
            UNION ALL
            SELECT g.fecha, 'GASTO', CONCAT('Gasto #', g.id), g.descripcion, 0, g.monto, u.nombre
            FROM gastos g
            INNER JOIN usuarios u ON u.id = g.usuario_id
            UNION ALL
            SELECT v.fecha, 'ANULACION', CONCAT('Factura #', v.id), CONCAT('Venta anulada de ', c.nombres),  v.total,0, u.nombre
            FROM ventas v
            INNER JOIN clientes c ON c.id = v.cliente_id
            INNER JOIN usuarios u ON u.id = v.usuario_id
            WHERE v.estado = 'ANULADA'
            UNION ALL
            SELECT c.fecha, 'ANULACION', CONCAT('COMPRA #', c.id), CONCAT('Compra anulada de ', p.nombre), 0, c.total, u.nombre
            FROM compras c
            INNER JOIN proveedores p ON p.id = c.proveedor_id
            INNER JOIN usuarios u ON u.id = c.usuario_id
            WHERE c.estado = 'ANULADA'
            ORDER BY fecha DESC;
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
