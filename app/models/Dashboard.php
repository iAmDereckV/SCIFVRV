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
        $ventasMes = $this->conexion
            ->query("
        SELECT IFNULL(SUM(total),0) total
        FROM ventas
        WHERE estado='COMPLETADA'
        AND MONTH(fecha)=MONTH(CURDATE())
        AND YEAR(fecha)=YEAR(CURDATE())
    ")
            ->fetch();

        $comprasMes = $this->conexion
            ->query("
        SELECT IFNULL(SUM(total),0) total
        FROM compras
        WHERE estado='COMPLETADA'
        AND MONTH(fecha)=MONTH(CURDATE())
        AND YEAR(fecha)=YEAR(CURDATE())
    ")
            ->fetch();

        $gastosMes = $this->conexion
            ->query("
        SELECT IFNULL(SUM(monto),0) total
        FROM gastos
        WHERE MONTH(fecha)=MONTH(CURDATE())
        AND YEAR(fecha)=YEAR(CURDATE())
    ")
            ->fetch();

        $stockBajo = $this->conexion
            ->query("
        SELECT COUNT(*) total
        FROM productos
        WHERE stock<=stock_minimo
        AND estado='ACTIVO'
    ")
            ->fetch();
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
            'ventas_hoy' => $ventas['total'],
            'ventas_mes' => $ventasMes['total'],
            'compras_mes' => $comprasMes['total'],
            'gastos_mes' => $gastosMes['total'],
            'utilidad' =>
            $ventasMes['total']
                -
                $gastosMes['total'],
            'productos' => $productos['total'],
            'clientes' => $clientes['total'],
            'facturas' => $facturas['total'],
            'stock_bajo' => $stockBajo['total']
        ];
    }
    public function ventasComprasMes()
    {
        $sql = "SELECT
        DATE_FORMAT(meses.mes,'%b') mes,
        IFNULL(v.total_ventas,0) ventas,
        IFNULL(c.total_compras,0) compras
    FROM
    (
        SELECT DATE_SUB(
            CURDATE(),
            INTERVAL n MONTH
        ) mes
        FROM (
            SELECT 0 n
            UNION SELECT 1
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
        ) x
    ) meses
    LEFT JOIN
    (
        SELECT
            YEAR(fecha) anio,
            MONTH(fecha) mes,
            SUM(total) total_ventas
        FROM ventas
        WHERE estado='COMPLETADA'
        GROUP BY YEAR(fecha),MONTH(fecha)
    ) v
    ON YEAR(meses.mes)=v.anio
    AND MONTH(meses.mes)=v.mes
    LEFT JOIN
    (
        SELECT
            YEAR(fecha) anio,
            MONTH(fecha) mes,
            SUM(total) total_compras
        FROM compras
        WHERE estado='COMPLETADA'
        GROUP BY YEAR(fecha),MONTH(fecha)
    ) c
    ON YEAR(meses.mes)=c.anio
    AND MONTH(meses.mes)=c.mes
    ORDER BY meses.mes;
    ";
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
    public function ventasPorVendedor()
    {
        $sql = "

    SELECT

        u.nombre,

        SUM(v.total) total

    FROM ventas v

    INNER JOIN usuarios u
        ON u.id=v.usuario_id

    WHERE v.estado='COMPLETADA'

    GROUP BY u.id

    ORDER BY total DESC

    LIMIT 10

    ";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function resumenFinanciero()
    {
        // Ventas del mes
        $ventas = $this->conexion
            ->query("
            SELECT IFNULL(SUM(total),0) total
            FROM ventas
            WHERE estado='COMPLETADA'
            AND MONTH(fecha)=MONTH(CURDATE())
            AND YEAR(fecha)=YEAR(CURDATE())
        ")
            ->fetch();

        // Costos de los productos vendidos
        $costos = $this->conexion
            ->query("
            SELECT IFNULL(
                SUM(costo_unitario * cantidad),
                0
            ) total
            FROM detalle_ventas dv

            INNER JOIN ventas v
                ON v.id = dv.venta_id

            WHERE v.estado='COMPLETADA'
            AND MONTH(v.fecha)=MONTH(CURDATE())
            AND YEAR(v.fecha)=YEAR(CURDATE())
        ")
            ->fetch();
        // Gastos del mes
        $gastos = $this->conexion
            ->query("
            SELECT IFNULL(SUM(monto),0) total
            FROM gastos
            WHERE MONTH(fecha)=MONTH(CURDATE())
            AND YEAR(fecha)=YEAR(CURDATE())
        ")
            ->fetch();

        $ventasTotal = (float)$ventas['total'];
        $costosTotal = (float)$costos['total'];
        $gastosTotal = (float)$gastos['total'];

        $utilidadBruta = $ventasTotal - $costosTotal;

        $utilidadNeta = $utilidadBruta - $gastosTotal;

        return [

            'ventas' => $ventasTotal,

            'costos' => $costosTotal,

            'gastos' => $gastosTotal,

            'utilidad_bruta' => $utilidadBruta,

            'utilidad' => $utilidadNeta

        ];
    }
    public function stockBajoTabla()
    {
        $sql = "

        SELECT

            nombre,

            stock,

            stock_minimo

        FROM productos

        WHERE estado='ACTIVO'

        AND stock<=stock_minimo

        ORDER BY stock ASC

        LIMIT 5

    ";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function ultimasVentas()
    {
        $sql = "

        SELECT

            v.id,

            c.nombres cliente,

            v.total

        FROM ventas v

        INNER JOIN clientes c

            ON c.id=v.cliente_id

        WHERE v.estado='COMPLETADA'

        ORDER BY v.id DESC

        LIMIT 5

    ";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function ultimasCompras()
    {
        $sql = "

        SELECT

            c.id,

            p.nombre proveedor,

            c.total

        FROM compras c

        INNER JOIN proveedores p

            ON p.id=c.proveedor_id

        WHERE c.estado='COMPLETADA'

        ORDER BY c.id DESC

        LIMIT 5

    ";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function actividadReciente()
    {
        $sql = "

        SELECT

            nombre,

            usuario,

            ultimo_acceso

        FROM usuarios

        WHERE estado='ACTIVO'

        AND ultimo_acceso IS NOT NULL

        ORDER BY ultimo_acceso DESC

        LIMIT 5

    ";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
}