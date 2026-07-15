<?php

require_once __DIR__ . '/../config/database.php';

class Rol
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function listar()
    {
        $sql = "SELECT * FROM roles
                ORDER BY id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function guardar($nombre, $descripcion)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO roles
                (nombre, descripcion)
                VALUES
                (:nombre, :descripcion)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion
            ]);

            $rol_id = $this->conexion->lastInsertId();

            // Dashboard (permiso_id = 1)
            $sql = "INSERT INTO rol_permisos
                (rol_id, permiso_id)
                VALUES
                (:rol_id, :permiso_id)";

            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                ':rol_id' => $rol_id,
                ':permiso_id' => 1
            ]);

            $this->conexion->commit();

            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            return false;
        }
    }

    public function actualizar(
        $id,
        $nombre,
        $descripcion
    ) {
        $sql = "UPDATE roles
                SET nombre=:nombre,
                    descripcion=:descripcion
                WHERE id=:id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion
        ]);
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        $sql = "UPDATE roles
                SET estado=:estado
                WHERE id=:id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
    public function obtenerPermisos($rol_id)
    {
        $sql = "

        SELECT

            p.id,
            p.codigo,
            p.descripcion,

            IF(
                rp.permiso_id IS NULL,
                0,
                1
            ) asignado

        FROM permisos p

        LEFT JOIN rol_permisos rp
            ON rp.permiso_id = p.id
            AND rp.rol_id = :rol_id

        ORDER BY p.codigo

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([
            ':rol_id' => $rol_id
        ]);

        return $stmt->fetchAll();
    }
    public function guardarPermisos(
        $rol_id,
        $permisos
    ) {

        $this->conexion->beginTransaction();

        try {

            $sql = "DELETE
                FROM rol_permisos
                WHERE rol_id = :rol_id";

            $stmt =
                $this->conexion->prepare($sql);

            $stmt->execute([
                ':rol_id' => $rol_id
            ]);

            foreach ($permisos as $permiso_id) {

                $sql = "INSERT INTO rol_permisos
                    (
                        rol_id,
                        permiso_id
                    )
                    VALUES
                    (
                        :rol_id,
                        :permiso_id
                    )";

                $stmt =
                    $this->conexion->prepare($sql);

                $stmt->execute([
                    ':rol_id' => $rol_id,
                    ':permiso_id' => $permiso_id
                ]);
            }

            $this->conexion->commit();

            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            return false;
        }
    }
}
