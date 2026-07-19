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
        $sql = "SELECT id,nombres,apellidos
                FROM clientes
                WHERE estado='ACTIVO'
                ORDER BY nombres";
        return $this->conexion->query($sql)->fetchAll();
    }

    public function obtenerProductos()
    {
        $sql = "SELECT id,codigo,nombre,precio_venta,stock
                FROM productos
                WHERE estado='ACTIVO'
                ORDER BY nombre";
        return $this->conexion->query($sql)->fetchAll();
    }

    public function listarVentas()
    {
        $sql = "SELECT v.*,CONCAT(c.nombres,' ',IFNULL(c.apellidos,'')) AS cliente
                FROM ventas v
                INNER JOIN clientes c ON c.id = v.cliente_id
                ORDER BY v.id DESC";
        return $this->conexion->query($sql)->fetchAll();
    }
    public function guardarVenta($cliente_id, $usuario_id, $subtotal, $impuesto, $descuento, $total, $detalle)
    {
        try {
            $this->conexion->beginTransaction();
            $sqlVenta = "INSERT INTO ventas
        (cliente_id,usuario_id,subtotal,impuesto,descuento,total)
        VALUES
        (:cliente_id,:usuario_id,:subtotal,:impuesto,:descuento,:total)";
            $stmtVenta = $this->conexion->prepare($sqlVenta);
            $stmtVenta->execute([
                ':cliente_id' => $cliente_id,
                ':usuario_id' => $usuario_id,
                ':subtotal'   => $subtotal,
                ':impuesto'   => $impuesto,
                ':descuento'  => $descuento,
                ':total'      => $total
            ]);
            $venta_id = $this->conexion->lastInsertId();
            foreach ($detalle as $item) {
                // Obtener stock y costo actual del producto
                $sqlProducto = "SELECT stock, precio_compra
                            FROM productos
                            WHERE id = :producto_id";
                $stmtProducto = $this->conexion->prepare($sqlProducto);
                $stmtProducto->execute([':producto_id' => $item['producto_id']]);
                $producto = $stmtProducto->fetch();
                if (!$producto) {
                    throw new Exception("Producto no encontrado.");
                }
                if ($producto['stock'] < $item['cantidad']) {
                    throw new Exception("Stock insuficiente para el producto.");
                }
                // Guardar detalle
                $sqlDetalle = "INSERT INTO detalle_ventas
            (venta_id,producto_id,cantidad,precio_unitario,costo_unitario,subtotal)
            VALUES
            (:venta_id,:producto_id,:cantidad,:precio,:costo,:subtotal)";
                $stmtDetalle = $this->conexion->prepare($sqlDetalle);
                $stmtDetalle->execute([
                    ':venta_id'   => $venta_id,
                    ':producto_id' => $item['producto_id'],
                    ':cantidad'   => $item['cantidad'],
                    ':precio'     => $item['precio'],
                    ':costo'      => $producto['precio_compra'],
                    ':subtotal'   => $item['subtotal']
                ]);
                // Descontar stock
                $sqlStock = "UPDATE productos
                         SET stock = stock - :cantidad
                         WHERE id = :producto_id";
                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([
                    ':cantidad'    => $item['cantidad'],
                    ':producto_id' => $item['producto_id']
                ]);
            }
            $this->conexion->commit();
            return $venta_id;
        } catch (Exception $e) {
            $this->conexion->rollBack();
            die("ERROR VENTA: " . $e->getMessage());
        }
    }
    public function anular($venta_id)
    {
        try {
            $sql = "SELECT estado
        FROM ventas
        WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id' => $venta_id]);
            $venta = $stmt->fetch();
            if ($venta['estado'] === 'ANULADA') {
                return false;
            }
            $this->conexion->beginTransaction();
            $sql = "SELECT producto_id,cantidad
                FROM detalle_ventas
                WHERE venta_id = :venta_id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':venta_id' => $venta_id]);
            $productos = $stmt->fetchAll();
            foreach ($productos as $producto) {
                $sqlStock = "UPDATE productos
                         SET stock = stock + :cantidad
                         WHERE id = :producto_id";
                $stmtStock = $this->conexion->prepare($sqlStock);
                $stmtStock->execute([
                    ':cantidad' => $producto['cantidad'],
                    ':producto_id' => $producto['producto_id']
                ]);
            }
            $sqlVenta = "UPDATE ventas
                     SET estado='ANULADA'
                     WHERE id=:id";
            $stmtVenta = $this->conexion->prepare($sqlVenta);
            $stmtVenta->execute([':id' => $venta_id]);
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {
            $this->conexion->rollBack();
            return false;
        }
    }
    public function reporteVentas()
    {
        $sql = "SELECT v.id,v.fecha,c.nombres cliente,u.nombre usuario,
                v.estado,v.subtotal,v.descuento,v.impuesto,v.total
                FROM ventas v
                INNER JOIN clientes c ON c.id = v.cliente_id
                INNER JOIN usuarios u ON u.id = v.usuario_id
                ORDER BY v.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function reporteVentasDetalladas()
    {
        $sql = "SELECT v.id factura,v.fecha,c.nombres cliente,p.codigo,p.nombre producto,u.nombre usuario,
            dv.cantidad,dv.precio_unitario,dv.costo_unitario,dv.subtotal,v.estado
        FROM detalle_ventas dv
        INNER JOIN ventas v ON v.id = dv.venta_id
        INNER JOIN clientes c ON c.id = v.cliente_id
        INNER JOIN productos p ON p.id = dv.producto_id
        INNER JOIN usuarios u ON u.id = v.usuario_id
        ORDER BY v.id DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}