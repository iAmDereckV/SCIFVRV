<?php

require_once '../../app/controllers/BackupController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'backup_eliminar'
);
header('Content-Type: application/json');

$controller =
    new BackupController();

$respaldo =
    $controller->obtenerRespaldo(
        $_POST['id']
    );

if (!$respaldo) {

    echo json_encode([
        'success' => false
    ]);

    exit;
}

$ruta =
    '../../database/backup/' .
    $respaldo['archivo'];

if (file_exists($ruta)) {

    unlink($ruta);
}

$resultado =
    $controller->eliminarRespaldo(
        $_POST['id']
    );

echo json_encode([
    'success' => $resultado
]);
