<?php

require_once __DIR__ . '/../config/database.php';

class Producto
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT
                p.*,
                c.nombre AS categoria,
                m.nombre AS marca
            FROM productos p
            INNER JOIN categorias c
                ON c.id = p.categoria_id
            INNER JOIN marcas m
                ON m.id = p.marca_id
            ORDER BY p.id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function obtenerCategorias()
    {
        return $this->conexion
            ->query("
                SELECT *
                FROM categorias
                WHERE estado='ACTIVO'
                ORDER BY nombre
            ")
            ->fetchAll();
    }

    public function obtenerMarcas()
    {
        return $this->conexion
            ->query("
                SELECT *
                FROM marcas
                WHERE estado='ACTIVO'
                ORDER BY nombre
            ")
            ->fetchAll();
    }
    public function guardar(
        $codigo,
        $categoria_id,
        $marca_id,
        $nombre,
        $descripcion,
        $vehiculo_aplicable,
        $precio_compra,
        $precio_venta,
        $stock,
        $stock_minimo,
        $ubicacion,
        $nombreImagen
    ) {
        $sql = "INSERT INTO productos
            (
                codigo,
                categoria_id,
                marca_id,
                nombre,
                descripcion,
                vehiculo_aplicable,
                precio_compra,
                precio_venta,
                stock,
                stock_minimo,
                ubicacion,
                imagen
            )
            VALUES
            (
                :codigo,
                :categoria_id,
                :marca_id,
                :nombre,
                :descripcion,
                :vehiculo_aplicable,
                :precio_compra,
                :precio_venta,
                :stock,
                :stock_minimo,
                :ubicacion,
                :nombreImagen
            )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':codigo' => $codigo,
            ':categoria_id' => $categoria_id,
            ':marca_id' => $marca_id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':vehiculo_aplicable' => $vehiculo_aplicable,
            ':precio_compra' => $precio_compra,
            ':precio_venta' => $precio_venta,
            ':stock' => $stock,
            ':stock_minimo' => $stock_minimo,
            ':ubicacion' => $ubicacion,
            ':nombreImagen' => $nombreImagen
        ]);
    }
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
            FROM productos
            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
    public function obtenerDetalle($id)
    {
        $sql = "SELECT
    p.*,
    c.nombre AS categoria,
    m.nombre AS marca
FROM productos p
INNER JOIN categorias c ON c.id = p.categoria_id
INNER JOIN marcas m ON m.id = p.marca_id
WHERE p.id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
    public function actualizar(
        $id,
        $codigo,
        $categoria_id,
        $marca_id,
        $nombre,
        $descripcion,
        $vehiculo_aplicable,
        $precio_compra,
        $precio_venta,
        $stock,
        $stock_minimo,
        $ubicacion
    ) {
        $sql = "UPDATE productos
            SET
                codigo = :codigo,
                categoria_id = :categoria_id,
                marca_id = :marca_id,
                nombre = :nombre,
                descripcion = :descripcion,
                vehiculo_aplicable = :vehiculo_aplicable,
                precio_compra = :precio_compra,
                precio_venta = :precio_venta,
                stock = :stock,
                stock_minimo = :stock_minimo,
                ubicacion = :ubicacion
            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':codigo' => $codigo,
            ':categoria_id' => $categoria_id,
            ':marca_id' => $marca_id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':vehiculo_aplicable' => $vehiculo_aplicable,
            ':precio_compra' => $precio_compra,
            ':precio_venta' => $precio_venta,
            ':stock' => $stock,
            ':stock_minimo' => $stock_minimo,
            ':ubicacion' => $ubicacion
        ]);
    }
    public function cambiarEstado(
        $id,
        $estado
    ) {
        $sql = "UPDATE productos
            SET estado = :estado
            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
    public function actualizarImagen(
        $id,
        $imagen
    ) {

        $sql = "UPDATE productos
            SET imagen = :imagen
            WHERE id = :id";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([

            ':imagen' => $imagen,

            ':id' => $id

        ]);
    }
}
