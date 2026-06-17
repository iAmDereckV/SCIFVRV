<?php

require_once __DIR__ . '/../config/database.php';

class Proveedor
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion =
            $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT *
                FROM proveedores
                ORDER BY id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function guardar(
        $nombre,
        $contacto,
        $telefono,
        $correo,
        $direccion
    ) {
        $sql = "INSERT INTO proveedores
                (
                    nombre,
                    contacto,
                    telefono,
                    correo,
                    direccion
                )
                VALUES
                (
                    :nombre,
                    :contacto,
                    :telefono,
                    :correo,
                    :direccion
                )";

        $stmt =
            $this->conexion
            ->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':contacto' => $contacto,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion
        ]);
    }

    public function obtener($id)
    {
        $sql = "SELECT *
                FROM proveedores
                WHERE id = :id";

        $stmt =
            $this->conexion
            ->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }

    public function actualizar(
        $id,
        $nombre,
        $contacto,
        $telefono,
        $correo,
        $direccion
    ) {
        $sql = "UPDATE proveedores
                SET

                nombre = :nombre,
                contacto = :contacto,
                telefono = :telefono,
                correo = :correo,
                direccion = :direccion

                WHERE id = :id";

        $stmt =
            $this->conexion
            ->prepare($sql);

        return $stmt->execute([

            ':id' => $id,

            ':nombre' => $nombre,

            ':contacto' => $contacto,

            ':telefono' => $telefono,

            ':correo' => $correo,

            ':direccion' => $direccion
        ]);
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        $sql = "UPDATE proveedores
                SET estado = :estado
                WHERE id = :id";

        $stmt =
            $this->conexion
            ->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
}
