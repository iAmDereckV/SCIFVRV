<?php

require_once __DIR__ . '/../config/database.php';

class Backup
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion = $db->conectar();
    }
    public function obtenerTablas()
    {
        return $this->conexion
            ->query("SHOW TABLES")
            ->fetchAll(PDO::FETCH_COLUMN);
    }

    public function obtenerRegistros($tabla)
    {
        return $this->conexion
            ->query("SELECT * FROM `$tabla`")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCreateTable($tabla)
    {
        $stmt = $this->conexion
            ->query("SHOW CREATE TABLE `$tabla`");

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['Create Table'];
    }
    public function registrarBackup(
        $usuario_id,
        $archivo
    ) {
        $sql = "INSERT INTO respaldos
    (
        usuario_id,
        archivo
    )
    VALUES
    (
        :usuario_id,
        :archivo
    )";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':archivo' => $archivo
        ]);
    }
    public function listarRespaldos()
    {
        $sql = "SELECT

                r.id,
                r.archivo,
                r.fecha,
                u.nombre AS usuario

            FROM respaldos r

            INNER JOIN usuarios u
                ON u.id = r.usuario_id

            ORDER BY r.id DESC";

        return $this->conexion
            ->query($sql)
            ->fetchAll();
    }
    public function eliminarRespaldo($id)
    {
        $sql = "DELETE
            FROM respaldos
            WHERE id = :id";

        $stmt =
            $this->conexion->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
    public function obtenerRespaldo($id)
    {
        $sql = "SELECT *
            FROM respaldos
            WHERE id = :id";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch();
    }
    public function restaurarSQL(
        $archivoTmp
    ) {

        try {
            $this->conexion->exec(
                "SET FOREIGN_KEY_CHECKS=0"
            );

            $sql =
                file_get_contents(
                    $archivoTmp
                );

            $consultas =
                explode(
                    ";",
                    $sql
                );

            foreach (
                $consultas as $consulta
            ) {

                $consulta =
                    trim($consulta);

                if (
                    !empty($consulta)
                ) {

                    $this->conexion->exec(
                        $consulta
                    );
                }
            }
            $this->conexion->exec(
                "SET FOREIGN_KEY_CHECKS=1"
            );

            return true;
        } catch (Exception $e) {

            return false;
        }
    }
}