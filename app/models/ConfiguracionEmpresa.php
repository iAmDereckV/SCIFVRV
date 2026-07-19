<?php

require_once __DIR__ . '/../config/database.php';

class ConfiguracionEmpresa
{
    private $conexion;
    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function obtener()
    {
        $sql = "SELECT *
            FROM configuracion_empresa
            LIMIT 1";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function actualizar($nombre, $ruc, $telefono, $correo, $direccion, $slogan, $logo,)
    {
        $sql = "UPDATE configuracion_empresa
        SET
            nombre_empresa = ?,
            ruc = ?,
            telefono = ?,
            correo = ?,
            direccion = ?,
            slogan = ?,
            logo = ?
        WHERE id = 1";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute([
            $nombre,
            $ruc,
            $telefono,
            $correo,
            $direccion,
            $slogan,
            $logo,
        ]);
    }
}