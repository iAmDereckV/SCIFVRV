<?php

require_once __DIR__ . '/../config/database.php';

class Venta
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function obtenerClientes()
    {
        $sql = "SELECT
                    id,
                    nombres,
                    apellidos
                FROM clientes
                WHERE estado='ACTIVO'
                ORDER BY nombres";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function obtenerProductos()
    {
        $sql = "SELECT
                    id,
                    codigo,
                    nombre,
                    precio_venta,
                    stock
                FROM productos
                WHERE estado='ACTIVO'
                ORDER BY nombre";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function listarVentas()
    {
        $sql = "SELECT
                    v.*,
                    CONCAT(
                        c.nombres,
                        ' ',
                        IFNULL(c.apellidos,'')
                    ) AS cliente
                FROM ventas v
                INNER JOIN clientes c
                    ON c.id = v.cliente_id
                ORDER BY v.id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function guardarVenta(
        $cliente_id,
        $usuario_id,
        $subtotal,
        $impuesto,
        $descuento,
        $total,
        $detalle
    ) {
        try {

            $this->conexion->beginTransaction();

            $sqlVenta = "INSERT INTO ventas
        (
            cliente_id,
            usuario_id,
            subtotal,
            impuesto,
            descuento,
            total
        )
        VALUES
        (
            :cliente_id,
            :usuario_id,
            :subtotal,
            :impuesto,
            :descuento,
            :total
        )";

            $stmtVenta =
                $this->conexion->prepare($sqlVenta);

            $stmtVenta->execute([
                ':cliente_id' => $cliente_id,
                ':usuario_id' => $usuario_id,
                ':subtotal' => $subtotal,
                ':impuesto' => $impuesto,
                ':descuento' => $descuento,
                ':total' => $total
            ]);

            $venta_id =
                $this->conexion->lastInsertId();

            foreach ($detalle as $item) {
                //? VERIFICAR STOCK
                $sqlVerificar = "SELECT stock
                     FROM productos
                     WHERE id = :producto_id";

                $stmtVerificar =
                    $this->conexion->prepare(
                        $sqlVerificar
                    );

                $stmtVerificar->execute([
                    ':producto_id' =>
                    $item['producto_id']
                ]);

                $producto =
                    $stmtVerificar->fetch();

                if (
                    $producto['stock']
                    <
                    $item['cantidad']
                ) {
                    throw new Exception(
                        'Stock insuficiente'
                    );
                }
                // ?VERIFICAR STOCK
                $sqlDetalle = "INSERT INTO detalle_ventas
            (
                venta_id,
                producto_id,
                cantidad,
                precio_unitario,
                subtotal
            )
            VALUES
            (
                :venta_id,
                :producto_id,
                :cantidad,
                :precio,
                :subtotal
            )";

                $stmtDetalle =
                    $this->conexion->prepare($sqlDetalle);

                $stmtDetalle->execute([
                    ':venta_id' => $venta_id,
                    ':producto_id' => $item['producto_id'],
                    ':cantidad' => $item['cantidad'],
                    ':precio' => $item['precio'],
                    ':subtotal' => $item['subtotal']
                ]);

                $sqlStock = "UPDATE productos
                         SET stock = stock - :cantidad
                         WHERE id = :producto_id";

                $stmtStock =
                    $this->conexion->prepare($sqlStock);

                $stmtStock->execute([
                    ':cantidad' => $item['cantidad'],
                    ':producto_id' => $item['producto_id']
                ]);
            }

            $this->conexion->commit();

            return $venta_id;
        } catch (Exception $e) {
            $this->conexion->rollBack();

            die("ERROR VENTA: " .
                $e->getMessage());
        }
    }
    public function anular($venta_id)
    {
        try {
            $sql = "SELECT estado
        FROM ventas
        WHERE id = :id";

            $stmt =
                $this->conexion->prepare($sql);

            $stmt->execute([
                ':id' => $venta_id
            ]);

            $venta =
                $stmt->fetch();

            if (
                $venta['estado']
                === 'ANULADA'
            ) {
                return false;
            }
            $this->conexion->beginTransaction();

            $sql = "SELECT
                    producto_id,
                    cantidad
                FROM detalle_ventas
                WHERE venta_id = :venta_id";

            $stmt =
                $this->conexion->prepare($sql);

            $stmt->execute([
                ':venta_id' => $venta_id
            ]);

            $productos =
                $stmt->fetchAll();

            foreach ($productos as $producto) {
                $sqlStock = "UPDATE productos
                         SET stock =
                             stock + :cantidad
                         WHERE id = :producto_id";

                $stmtStock =
                    $this->conexion->prepare(
                        $sqlStock
                    );

                $stmtStock->execute([
                    ':cantidad' =>
                    $producto['cantidad'],

                    ':producto_id' =>
                    $producto['producto_id']
                ]);
            }

            $sqlVenta = "UPDATE ventas
                     SET estado='ANULADA'
                     WHERE id=:id";

            $stmtVenta =
                $this->conexion->prepare(
                    $sqlVenta
                );

            $stmtVenta->execute([
                ':id' => $venta_id
            ]);

            $this->conexion->commit();

            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            return false;
        }
    }
    public function reporteVentas()
    {
        $sql = "

        SELECT

            v.id,

            v.fecha,

            c.nombres cliente,

            v.total,

            v.estado

        FROM ventas v

        INNER JOIN clientes c
            ON c.id = v.cliente_id

        ORDER BY v.fecha DESC

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function reporteVentasDetalladas()
    {
        $sql = "

        SELECT

            v.id factura,

            v.fecha,

            c.nombres cliente,

            p.codigo,

            p.nombre producto,

            dv.cantidad,

            dv.precio_unitario,

            dv.subtotal,

            v.estado

        FROM detalle_ventas dv

        INNER JOIN ventas v
            ON v.id = dv.venta_id

        INNER JOIN clientes c
            ON c.id = v.cliente_id

        INNER JOIN productos p
            ON p.id = dv.producto_id

        ORDER BY v.id DESC

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}