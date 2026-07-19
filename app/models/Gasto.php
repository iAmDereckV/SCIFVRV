<?php

require_once __DIR__ . '/../config/database.php';

class Gasto
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT g.id,cg.nombre AS categoria,g.descripcion,g.monto,
                g.fecha,g.archivo_factura,u.nombre AS usuario
            FROM gastos g
            INNER JOIN categorias_gastos cg ON cg.id = g.categoria_id
            INNER JOIN usuarios u ON u.id = g.usuario_id
            ORDER BY g.fecha DESC";
        return $this->conexion->query($sql)->fetchAll();
    }
    public function obtenerCategorias()
    {
        $sql = "SELECT *
            FROM categorias_gastos
            ORDER BY nombre";
        return $this->conexion->query($sql)->fetchAll();
    }
    public function guardar($categoria_id, $descripcion, $monto, $fecha, $usuario_id, $archivo)
    {
        $sql = "INSERT INTO gastos
            (categoria_id,usuario_id,descripcion,monto,fecha,archivo_factura)
            VALUES
            (:categoria_id,:usuario_id,:descripcion,:monto,:fecha,:archivo_factura)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':categoria_id' => $categoria_id,
            ':usuario_id' => $usuario_id,
            ':descripcion' => $descripcion,
            ':monto' => $monto,
            ':fecha' => $fecha,
            ':archivo_factura' => $archivo
        ]);
    }
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
            FROM gastos
            WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function actualizar($id, $categoria_id, $descripcion, $monto, $fecha)
    {
        $sql = "UPDATE gastos
            SET
                categoria_id = :categoria_id,
                descripcion = :descripcion,
                monto = :monto,
                fecha = :fecha
            WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':categoria_id' => $categoria_id,
            ':descripcion' => $descripcion,
            ':monto' => $monto,
            ':fecha' => $fecha
        ]);
    }
    public function reporteGastos()
    {
        $sql = "SELECT g.id,g.fecha,cg.nombre categoria,g.descripcion,g.monto,u.nombre usuario,g.archivo_factura
        FROM gastos g
        INNER JOIN categorias_gastos cg ON cg.id = g.categoria_id
        INNER JOIN usuarios u ON u.id = g.usuario_id
        ORDER BY g.fecha DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function actualizarComprobante($id, $archivo)
    {
        $sql = "UPDATE gastos
            SET archivo_factura = :archivo
            WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':archivo' => $archivo,
            ':id' => $id
        ]);
    }
    public function cgobtener($id)
    {
        $sql = "SELECT *
                FROM categorias_gastos
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function cgGuardar($nombre)
    {
        $sql = "INSERT INTO categorias_gastos(nombre)
                VALUES(:nombre)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':nombre' => $nombre]);
        return $this->conexion->lastInsertId();
    }
    public function cgActualizar($id, $nombre)
    {
        $sql = "UPDATE categorias_gastos
                SET nombre = :nombre
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':id' => $id
        ]);
    }
}