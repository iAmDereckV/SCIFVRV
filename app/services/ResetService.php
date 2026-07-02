<?php

require_once __DIR__ . '/../config/database.php';

class ResetService
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }
    public function ejecutar()
    {
        try {

            $this->conexion->beginTransaction();
            $this->limpiarTablas();
            // $this->limpiarBaseDatos();
            // $this->eliminarArchivosSubidos();
            // $this->ejecutarSeed();
            $this->conexion->commit();
            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            throw $e;
        }
    }
    private function limpiarTablas()
    {
        $this->conexion->exec("SET FOREIGN_KEY_CHECKS = 0");
        $tablas = [
            'categorias',
            'categorias_gastos',
            'clientes',
            'compras',
            // 'configuracion_empresa',
            'detalle_compras',
            'detalle_ventas',
            'gastos',
            'marcas',
            'permisos',
            'productos',
            'proveedores',
            // 'rol_permisos',
            // 'roles',
            // 'usuarios',
            'ventas'
        ];
        foreach ($tablas as $tabla) {

            $this->conexion->exec("TRUNCATE TABLE $tabla");
        }

        $this->conexion->exec("SET FOREIGN_KEY_CHECKS = 1");
    }
    private function reiniciar()
    {
        try {
            $this->conexion->beginTransaction();




            $sql = file_get_contents(
                __DIR__ . '/../../database/seed.sql'
            );

            $this->conexion->exec($sql);
            $this->conexion->commit();

            return true;
        } catch (Exception $e) {

            $this->conexion->rollBack();

            return false;
        }
    }
}
