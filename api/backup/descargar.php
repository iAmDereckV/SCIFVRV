<?php
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'backup_restaurar'
);
$archivo =
    basename($_GET['archivo']);

$ruta =
    '../../database/backup/' .
    $archivo;

if (!file_exists($ruta)) {

    die('Archivo no encontrado');
}

header('Content-Type: application/octet-stream');

header(
    'Content-Disposition: attachment; filename="' .
        $archivo .
        '"'
);

header(
    'Content-Length: ' .
        filesize($ruta)
);

readfile($ruta);

exit;
