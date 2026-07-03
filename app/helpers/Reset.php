<?php

require_once __DIR__ . '/../config/database.php';

class Reset
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function reiniciar()
    {
        try {
            $this->conexion->beginTransaction();
            $this->conexion->exec("SET FOREIGN_KEY_CHECKS = 0");
            $this->limpiarTablas();
            $this->ejecutarSeed();
            $this->conexion->exec("SET FOREIGN_KEY_CHECKS = 1");
            $this->conexion->commit();
            $this->eliminarArchivos();
            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            throw $e;
        }
    }
    private function limpiarTablas()
    {

        $tablas = [
            'categorias',
            'categorias_gastos',
            'clientes',
            'compras',
            'configuracion_empresa',
            'detalle_compras',
            'detalle_ventas',
            'gastos',
            'marcas',
            'permisos',
            'productos',
            'proveedores',
            'respaldos',
            'rol_permisos',
            'roles',
            'usuarios',
            'ventas'
        ];
        foreach ($tablas as $tabla) {

            $this->conexion->exec("TRUNCATE TABLE $tabla");
        }
    }
    private function eliminarArchivos()
    {
        $carpetas = [
            __DIR__ . '/../../public/uploads/facturas',
            __DIR__ . '/../../public/uploads/gastos',
            __DIR__ . '/../../public/uploads/empresa'
        ];

        foreach ($carpetas as $carpeta) {

            if (!is_dir($carpeta)) {
                continue;
            }

            foreach (glob($carpeta . '/*') as $archivo) {

                $nombre = basename($archivo);

                if (
                    $nombre === 'index.html'
                    ||
                    $nombre === '.gitkeep'
                ) {
                    continue;
                }

                if (is_file($archivo)) {

                    unlink($archivo);
                }
            }
        }
    }
    private function ejecutarSeed()
    {
        $archivo =
            file_get_contents(
                __DIR__ . '/../../database/seed.sql'
            );
        if (!file_exists($archivo)) {
            throw new Exception('No se encontró el archivo seed.sql');
        }
        $sql = file_get_contents($archivo);
        $this->conexion->exec($sql);
    }
}