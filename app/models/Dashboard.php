<?php

require_once __DIR__ . '/../config/database.php';

class Dashboard
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion =
            $db->conectar();
    }

    public function resumen()
    {
        $ventas =
            $this->conexion
            ->query("
                SELECT
                IFNULL(
                    SUM(total),
                    0
                ) total
                FROM ventas
                WHERE DATE(fecha)=CURDATE()
            ")
            ->fetch();

        $productos =
            $this->conexion
            ->query("
                SELECT COUNT(*) total
                FROM productos
            ")
            ->fetch();

        $clientes =
            $this->conexion
            ->query("
                SELECT COUNT(*) total
                FROM clientes
            ")
            ->fetch();

        $facturas =
            $this->conexion
            ->query("
                SELECT COUNT(*) total
                FROM ventas
            ")
            ->fetch();

        return [
            'ventas_hoy' =>
            $ventas['total'],

            'productos' =>
            $productos['total'],

            'clientes' =>
            $clientes['total'],

            'facturas' =>
            $facturas['total']
        ];
    }
    public function ventasMes()
    {
        $sql = "SELECT
                MONTH(fecha) mes,
                SUM(total) total
            FROM ventas
            GROUP BY MONTH(fecha)
            ORDER BY MONTH(fecha)";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function productosVendidos()
    {
        $sql = "SELECT
                p.nombre,
                SUM(d.cantidad) cantidad
            FROM detalle_ventas d
            INNER JOIN productos p
                ON p.id = d.producto_id
            GROUP BY p.id
            ORDER BY cantidad DESC
            LIMIT 10";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function stockBajo()
    {
        $sql = "SELECT
                nombre,
                stock,
                stock_minimo
            FROM productos
            WHERE stock <= stock_minimo
            ORDER BY stock ASC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function resumenFinanciero()
    {
        $ventas = $this->conexion
            ->query("
            SELECT
                IFNULL(SUM(total),0) total
            FROM ventas
            WHERE MONTH(fecha)=MONTH(CURDATE())
            AND YEAR(fecha)=YEAR(CURDATE())
        ")
            ->fetch();

        $gastos = $this->conexion
            ->query("
            SELECT
                IFNULL(SUM(monto),0) total
            FROM gastos
            WHERE MONTH(fecha)=MONTH(CURDATE())
            AND YEAR(fecha)=YEAR(CURDATE())
        ")
            ->fetch();

        return [

            'ventas' =>
            $ventas['total'],

            'gastos' =>
            $gastos['total'],

            'utilidad' => (
                $ventas['total']
                -
                $gastos['total']
            )

        ];
    }
}