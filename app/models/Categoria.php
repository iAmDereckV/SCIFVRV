<?php

require_once __DIR__ . '/../config/database.php';


class Categoria
{
    private $conexion;
    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function listar()
    {
        $sql = "SELECT *
                FROM categorias
                ORDER BY id DESC";
        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function guardar($nombre, $descripcion)
    {
        $sql = "INSERT INTO categorias
                (nombre,descripcion)
                VALUES
                (:nombre,:descripcion)";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion
        ]);
    }
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM categorias
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function actualizar($id, $nombre, $descripcion)
    {
        $sql = "UPDATE categorias
                SET nombre = :nombre,descripcion = :descripcion
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion
        ]);
    }
    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE categorias
                SET estado = :estado
                WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
}