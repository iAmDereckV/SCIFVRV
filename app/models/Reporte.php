<?php

require_once __DIR__ . '/../config/database.php';

class Reporte
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function ventasPorFecha($inicio, $fin)
    {
        $sql = "SELECT v.id,v.fecha,v.total,v.estado,c.nombres cliente,u.nombre usuario
                FROM ventas v
                INNER JOIN clientes c ON c.id = v.cliente_id
                INNER JOIN usuarios u ON u.id = v.usuario_id
                WHERE DATE(v.fecha) BETWEEN :inicio AND :fin
                ORDER BY v.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':inicio' => $inicio,
            ':fin' => $fin
        ]);
        return $stmt->fetchAll();
    }
    public function comprasPorFecha($inicio, $fin)
    {
        $sql = "SELECT c.id,c.fecha, c.total,c.estado,c.archivo_factura,
            p.nombre proveedor, u.nombre usuario
        FROM compras c
        INNER JOIN proveedores p ON p.id = c.proveedor_id
        INNER JOIN usuarios u ON u.id = c.usuario_id
        WHERE DATE(c.fecha) BETWEEN :inicio AND :fin
        ORDER BY c.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':inicio' => $inicio,
            ':fin' => $fin
        ]);
        return $stmt->fetchAll();
    }
    public function gastosPorFecha($inicio, $fin)
    {
        $sql = "SELECT g.id,g.fecha,g.descripcion,g.archivo_factura,
            g.monto,cg.nombre categoria,u.nombre usuario
        FROM gastos g
        INNER JOIN categorias_gastos cg ON cg.id = g.categoria_id
        INNER JOIN usuarios u ON u.id = g.usuario_id
        WHERE g.fecha BETWEEN :inicio AND :fin
        ORDER BY g.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([
            ':inicio' => $inicio,
            ':fin' => $fin
        ]);
        return $stmt->fetchAll();
    }
}