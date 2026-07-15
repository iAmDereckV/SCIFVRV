<?php

require_once __DIR__ . '/../config/Database.php';

class Kardex
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion =
            $db->conectar();
    }

    public function consultar(
        $producto_id
    ) {
        $sql = "SELECT
            DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s') AS fecha,
            fecha AS fecha_orden,
            'COMPRA' tipo,
            cantidad,
            CONCAT(
                'Compra #',
                compra_id
            ) detalle

        FROM detalle_compras dc

        INNER JOIN compras c
            ON c.id = dc.compra_id

        WHERE producto_id = :producto_id

        UNION ALL

        SELECT
            DATE_FORMAT(fecha, '%d/%m/%Y %H:%i:%s') AS fecha,
            fecha AS fecha_orden,
            'VENTA' tipo,
            cantidad,
            CONCAT(
                'Venta #',
                venta_id
            ) detalle

        FROM detalle_ventas dv

        INNER JOIN ventas v
            ON v.id = dv.venta_id

        WHERE producto_id = :producto_id

        ORDER BY fecha_orden ASC
        ";

        $stmt =
            $this->conexion->prepare(
                $sql
            );

        $stmt->execute([
            ':producto_id' =>
            $producto_id
        ]);

        return $stmt->fetchAll();
    }
    public function obtenerProducto($id)
    {
        $sql = "SELECT

                codigo,
                nombre,
                stock,
                stock_minimo,
                imagen,
                estado

            FROM productos

            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
}
