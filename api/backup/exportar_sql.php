<?php

require_once '../../app/controllers/BackupController.php';
require_once '../../app/helpers/Session.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'backup_generar'
);
Session::iniciar();

$controller =
    new BackupController();

$sql =
    $controller->generarSQL();

$nombreArchivo =
    'backup_' .
    date('Ymd_His') .
    '.sql';

$ruta =
    '../../database/backup/' .
    $nombreArchivo;


header('Content-Length: ' . strlen($sql));
header('Content-Type: application/sql');

header(
    'Content-Disposition: attachment; filename="' .
        $nombreArchivo .
        '"'
);
file_put_contents(
    $ruta,
    $sql
);
$controller->registrarBackup(
    Session::get('usuario_id'),
    $nombreArchivo
);

echo $sql;