<?php

require_once __DIR__ . '/../config/database.php';

class Cliente
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
                FROM clientes
                ORDER BY id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }

    public function guardar(
        $nombres,
        $apellidos,
        $telefono,
        $correo,
        $direccion,
        $identificacion,
        $tipo_cliente
    ) {
        $sql = "INSERT INTO clientes
                (
                    nombres,
                    apellidos,
                    telefono,
                    correo,
                    direccion,
                    identificacion,
                    tipo_cliente
                )
                VALUES
                (
                    :nombres,
                    :apellidos,
                    :telefono,
                    :correo,
                    :direccion,
                    :identificacion,
                    :tipo_cliente
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion,
            ':identificacion' => $identificacion,
            ':tipo_cliente' => $tipo_cliente
        ]);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM clientes
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }

    public function actualizar(
        $id,
        $nombres,
        $apellidos,
        $telefono,
        $correo,
        $direccion,
        $identificacion,
        $tipo_cliente
    ) {
        $sql = "UPDATE clientes
                SET
                    nombres = :nombres,
                    apellidos = :apellidos,
                    telefono = :telefono,
                    correo = :correo,
                    direccion = :direccion,
                    identificacion = :identificacion,
                    tipo_cliente = :tipo_cliente
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nombres' => $nombres,
            ':apellidos' => $apellidos,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion,
            ':identificacion' => $identificacion,
            ':tipo_cliente' => $tipo_cliente
        ]);
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        $sql = "UPDATE clientes
                SET estado = :estado
                WHERE id = :id";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':estado' => $estado
        ]);
    }
    public function obtenerTiposCliente()
    {
        $sql = "
SHOW COLUMNS
FROM clientes
LIKE 'tipo_cliente'
";

        $fila = $this->conexion
            ->query($sql)
            ->fetch();

        preg_match("/^enum\((.*)\)$/", $fila['Type'], $matches);

        $tipos = str_getcsv($matches[1], ',', "'");

        return $tipos;
    }
}
