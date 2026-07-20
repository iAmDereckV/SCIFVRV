<?php

class Instalador
{
    private mysqli $conexion;
    /** Conectar al servidor MySQL */
    public function conectar(string $host, string $usuario, string $password, int $puerto = 3306): void
    {

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conexion = new mysqli($host, $usuario, $password, '', $puerto);
        $this->conexion->set_charset('utf8mb4');
    }

    /** Crear Base de Datos */
    public function crearBase(string $baseDatos): void
    {
        $sql = "CREATE DATABASE IF NOT EXISTS `$baseDatos`
            CHARACTER SET utf8mb4
            COLLATE utf8mb4_general_ci";
        $this->conexion->query($sql);
    }
    public function seleccionarBase(string $baseDatos): void
    {
        $this->conexion->select_db($baseDatos);
    }

    /** Ejecutar archivo SQL */
    public function ejecutarSQL(string $archivo): void
    {
        if (!file_exists($archivo)) {
            throw new Exception("No existe el archivo: {$archivo}");
        }
        $contenido = file_get_contents($archivo);
        $this->conexion->multi_query($contenido);
        do {
            if ($resultado = $this->conexion->store_result()) {
                $resultado->free();
            }
        } while (
            $this->conexion->more_results() && $this->conexion->next_result()
        );
    }

    /** Crear config/database.php */
    public function guardarConfiguracion(string $host, string $usuario, string $password, string $baseDatos, string $irl, int $puerto = 3306): void
    {
        $contenido = <<<PHP
<?php
return [
    'host' => '{$host}',
    'port' => {$puerto},
    'database' => '{$baseDatos}',
    'username' => '{$usuario}',
    'password' => '{$password}',
    'irl' => '{$irl}',
];
PHP;
        file_put_contents(__DIR__ . '/../../app/config/config.php', $contenido);
    }
    public function ejecutarSchema(): void
    {
        $this->ejecutarSQL(__DIR__ . '/../../database/schema.sql');
    }
    public function ejecutarSeed(): void
    {
        $this->ejecutarSQL(__DIR__ . '/../../database/seed.sql');
    }
    /**
     * Crear installed.lock
     */
    public function crearLock(string $baseDatos, string $version = '1.0.0'): void
    {
        $datos = [
            'app' => 'SCIFVRV',
            'version' => $version,
            'database' => $baseDatos,
            'installed_at' => date('Y-m-d H:i:s')
        ];
        file_put_contents(__DIR__ . '/../../storage/installed.lock', json_encode($datos, JSON_PRETTY_PRINT));
    }
    /** Verifica si el sistema ya fue instalado */
    public static function instalado(): bool
    {
        return file_exists(__DIR__ . '/../../storage/installed.lock');
    }

    /** Redireccionar al sistema */
    public function finalizar(): void
    {
        header('Location: ../public/index.php');
        exit;
    }
    /** Cerrar conexión */
    public function cerrar(): void
    {
        if (isset($this->conexion)) {
            $this->conexion->close();
        }
    }
}