<?php

require_once __DIR__ . '/../config/database.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    public function buscarPorUsuario($usuario)
    {
        $sql = "SELECT
            u.*,
            r.nombre AS rol_nombre,
            r.estado AS rol_estado
        FROM usuarios u
        INNER JOIN roles r
            ON r.id = u.rol_id
        WHERE u.usuario = :usuario
        LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(
            ':usuario',
            $usuario
        );
        $stmt->execute();
        return $stmt->fetch();
    }

    public function listar()
    {
        $sql = "SELECT
                    u.*,
                    r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r
                    ON r.id = u.rol_id
                ORDER BY u.id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function obtenerRoles()
    {
        $sql = "SELECT *
                FROM roles
                WHERE estado='ACTIVO'
                ORDER BY nombre";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function guardar(
        $rol_id,
        $nombre,
        $usuario,
        $correo,
        $password,
        $nombreImagen
    ) {
        $sql = "INSERT INTO usuarios
                (
                    rol_id,
                    nombre,
                    usuario,
                    correo,
                    password,
                    foto
                )
                VALUES
                (
                    :rol_id,
                    :nombre,
                    :usuario,
                    :correo,
                    :password,
                    :nombreImagen
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':rol_id' => $rol_id,
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':correo' => $correo,
            ':password' => $password,
            ':nombreImagen' => $nombreImagen
        ]);
    }

    public function cambiarEstado($id, $estado)
    {
        $sql = "UPDATE usuarios
                SET estado = :estado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
    public function obtenerPorId($id)
    {
        $sql = "SELECT *
            FROM usuarios
            WHERE id = :id
            LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch();
    }
    public function actualizar(
        $id,
        $rol_id,
        $nombre,
        $usuario,
        $correo
    ) {
        $sql = "UPDATE usuarios
            SET
                rol_id = :rol_id,
                nombre = :nombre,
                usuario = :usuario,
                correo = :correo
            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':rol_id' => $rol_id,
            ':nombre' => $nombre,
            ':usuario' => $usuario,
            ':correo' => $correo
        ]);
    }
    public function actualizarUltimoAcceso($id)
    {
        $sql = "UPDATE usuarios
            SET ultimo_acceso = NOW()
            WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function actualizarFoto(
        $id,
        $foto
    ) {

        $sql = "UPDATE usuarios
            SET foto = :foto
            WHERE id = :id";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            ':foto' => $foto,
            ':id'   => $id
        ]);
    }
    public function obtenerPermisos($rol_id)
    {
        $sql = "

        SELECT
            p.codigo
        FROM rol_permisos rp
        INNER JOIN permisos p
            ON p.id = rp.permiso_id
        WHERE rp.rol_id = :rol_id

    ";
        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([
            ':rol_id' => $rol_id
        ]);

        return $stmt->fetchAll(
            PDO::FETCH_COLUMN
        );
    }
    public function verificarSesion($id)
    {
        $sql = "SELECT
                u.id,
                u.estado,
                r.estado AS rol_estado
            FROM usuarios u
            INNER JOIN roles r
                ON r.id = u.rol_id
            WHERE u.id = :id
            LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
}
