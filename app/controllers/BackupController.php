<?php

require_once __DIR__ . '/../models/Backup.php';
require_once __DIR__ . '/../helpers/Reset.php';

class BackupController
{
    private $backup;
    private $reset;

    public function __construct()
    {
        $this->backup = new Backup();
        $this->reset = new Reset();
    }

    public function generarSQL()
    {
        $sql = "";

        $tablas = $this->backup
            ->obtenerTablas();

        foreach ($tablas as $tabla) {

            $sql .= "\n\n";
            $sql .= "DROP TABLE IF EXISTS `$tabla`;\n";

            $create =
                $this->backup
                ->obtenerCreateTable($tabla);

            $sql .= $create . ";\n\n";

            $registros =
                $this->backup
                ->obtenerRegistros($tabla);

            foreach ($registros as $fila) {

                $columnas =
                    array_keys($fila);

                $valores = [];

                foreach ($fila as $valor) {

                    if ($valor === null) {

                        $valores[] = "NULL";
                    } else {

                        $valores[] =
                            "'" .
                            addslashes($valor) .
                            "'";
                    }
                }

                $sql .= "INSERT INTO `$tabla` (";

                $sql .= implode(
                    ",",
                    $columnas
                );

                $sql .= ") VALUES (";

                $sql .= implode(
                    ",",
                    $valores
                );

                $sql .= ");\n";
            }
        }

        return $sql;
    }
    public function registrarBackup(
        $usuario_id,
        $archivo
    ) {
        return $this->backup
            ->registrarBackup(
                $usuario_id,
                $archivo
            );
    }
    public function listarRespaldos()
    {
        return $this->backup
            ->listarRespaldos();
    }
    public function obtenerRespaldo($id)
    {
        return $this->backup
            ->obtenerRespaldo($id);
    }
    public function reiniciar()
    {
        return $this->reset->reiniciar();
    }
    public function eliminarRespaldo($id)
    {
        return $this->backup
            ->eliminarRespaldo($id);
    }
    private function agregarCarpetaZip(
        $zip,
        $carpeta,
        $base = ''
    ) {
        $archivos =
            scandir($carpeta);

        foreach (
            $archivos as $archivo
        ) {

            if (
                $archivo == '.'
                ||
                $archivo == '..'
            ) {
                continue;
            }

            $ruta =
                $carpeta .
                '/' .
                $archivo;

            $rutaZip =
                $base .
                $archivo;

            if (is_dir($ruta)) {

                $this->agregarCarpetaZip(
                    $zip,
                    $ruta,
                    $rutaZip . '/'
                );
            } else {

                $zip->addFile(
                    $ruta,
                    $rutaZip
                );
            }
        }
    }
    public function exportarZip()
    {
        $fecha =
            date('Ymd_His');

        $nombreZip =
            "respaldo_completo_" .
            $fecha .
            ".zip";

        $rutaZip =
            sys_get_temp_dir() .
            '/' .
            $nombreZip;

        $zip = new ZipArchive();

        if (
            $zip->open(
                $rutaZip,
                ZipArchive::CREATE
            ) !== TRUE
        ) {
            die('No se pudo crear ZIP');
        }

        // AGREGAR CARPETA UPLOADS
        $uploads =
            __DIR__ .
            '/../../public/uploads';

        $this->agregarCarpetaZip(
            $zip,
            $uploads,
            'uploads/'
        );
        // AGREGAR CARPETA BACKUP
        $sql =
            $this->generarSQL();

        $zip->addFromString(
            'backup.sql',
            $sql
        );
        // CERRAR ZIP
        $zip->close();

        header('Content-Type: application/zip');

        header(
            'Content-Disposition: attachment; filename="' .
                $nombreZip .
                '"'
        );

        readfile($rutaZip);
        unlink($rutaZip);
        exit;
    }
    public function restaurarSQL(
        $archivoTmp
    ) {
        return $this->backup
            ->restaurarSQL(
                $archivoTmp
            );
    }
    public function restaurarZip($archivoTmp)
    {
        try {

            $zip = new ZipArchive();

            if ($zip->open($archivoTmp) !== TRUE) {
                return false;
            }

            $destino =
                __DIR__ .
                '/../../public/uploads/';

            for ($i = 0; $i < $zip->numFiles; $i++) {

                $nombre =
                    $zip->getNameIndex($i);

                if (
                    strpos(
                        $nombre,
                        'uploads/'
                    ) !== 0
                ) {
                    continue;
                }

                $rutaRelativa =
                    substr(
                        $nombre,
                        strlen('uploads/')
                    );

                if (empty($rutaRelativa)) {
                    continue;
                }

                $rutaDestino =
                    $destino .
                    $rutaRelativa;

                if (
                    substr($nombre, -1)
                    == '/'
                ) {

                    if (
                        !is_dir($rutaDestino)
                    ) {
                        mkdir(
                            $rutaDestino,
                            0777,
                            true
                        );
                    }
                } else {

                    $carpeta =
                        dirname(
                            $rutaDestino
                        );

                    if (
                        !is_dir($carpeta)
                    ) {
                        mkdir(
                            $carpeta,
                            0777,
                            true
                        );
                    }

                    copy(
                        "zip://{$archivoTmp}#{$nombre}",
                        $rutaDestino
                    );
                }
            }

            $zip->close();

            return true;
        } catch (Exception $e) {

            return false;
        }
    }
}