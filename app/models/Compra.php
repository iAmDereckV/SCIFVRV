<?php

require_once __DIR__ . '/../config/database.php';

class Compra
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion =
            $db->conectar();
    }

    public function obtenerProveedores()
    {
        $sql = "SELECT *
            FROM proveedores
            WHERE estado='ACTIVO'
            ORDER BY nombre";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function obtenerProductos()
    {
        $sql = "SELECT *
            FROM productos
            WHERE estado='ACTIVO'
            ORDER BY nombre";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function guardar(
        $proveedor_id,
        $usuario_id,
        $factura,
        $archivoFactura,
        $productos,
        $total
    ) {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO compras
(
    proveedor_id,
    usuario_id,
    factura_proveedor,
    archivo_factura,
    total
)
                VALUES
                (
    :proveedor_id,
    :usuario_id,
    :factura,
    :archivo_factura,
    :total
)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([

                ':proveedor_id' => $proveedor_id,

                ':usuario_id' => $usuario_id,

                ':factura' => $factura,

                ':archivo_factura' => $archivoFactura,

                ':total' => $total

            ]);

            $compra_id = $this->conexion->lastInsertId();

            foreach ($productos as $item) {

                $sqlDetalle = "INSERT INTO detalle_compras
                            (
                                compra_id,
                                producto_id,
                                cantidad,
                                costo,
                                subtotal
                            )
                            VALUES
                            (
                                :compra_id,
                                :producto_id,
                                :cantidad,
                                :costo,
                                :subtotal
                            )";

                $stmtDetalle =
                    $this->conexion->prepare(
                        $sqlDetalle
                    );

                $stmtDetalle->execute([

                    ':compra_id' =>
                    $compra_id,

                    ':producto_id' =>
                    $item['producto_id'],

                    ':cantidad' =>
                    $item['cantidad'],

                    ':costo' =>
                    $item['costo'],

                    ':subtotal' =>
                    $item['subtotal']

                ]);

                $sqlStock = "UPDATE productos
                         SET

                         stock = stock + :cantidad,

                         precio_compra  = :costo

                         WHERE id = :id";

                $stmtStock =
                    $this->conexion->prepare(
                        $sqlStock
                    );

                $stmtStock->execute([

                    ':cantidad' =>
                    $item['cantidad'],

                    ':costo' =>
                    $item['costo'],

                    ':id' =>
                    $item['producto_id']

                ]);
            }

            $this->conexion->commit();

            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();
            return false;
        }
    }

    public function listar()
    {
        $sql = "SELECT

                c.id,
                c.fecha,
                c.total,

                c.factura_proveedor,

                c.archivo_factura,

                p.nombre AS proveedor,

                u.nombre AS usuario

            FROM compras c

            INNER JOIN proveedores p
                ON p.id = c.proveedor_id

            INNER JOIN usuarios u
                ON u.id = c.usuario_id

            ORDER BY c.id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function reporteCompras()
    {
        $sql = "

        SELECT

            c.id,

            c.fecha,

            p.nombre proveedor,

            c.factura_proveedor,

            c.total

        FROM compras c

        INNER JOIN proveedores p
            ON p.id = c.proveedor_id

        ORDER BY c.fecha DESC

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function reporteComprasDetalladas()
    {
        $sql = "

        SELECT

            c.id compra,

            c.fecha,

            p.nombre proveedor,

            pr.codigo,

            pr.nombre producto,

            dc.cantidad,

            dc.costo,

            dc.subtotal

        FROM detalle_compras dc

        INNER JOIN compras c
            ON c.id = dc.compra_id

        INNER JOIN proveedores p
            ON p.id = c.proveedor_id

        INNER JOIN productos pr
            ON pr.id = dc.producto_id

        ORDER BY c.id DESC

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}