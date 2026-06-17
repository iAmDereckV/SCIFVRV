<?php

require_once '../../app/controllers/BackupController.php';

header('Content-Type: application/json');

if (
    !isset($_FILES['archivo_sql'])
) {

    echo json_encode([
        'success' => false,
        'mensaje' => 'Archivo no recibido'
    ]);

    exit;
}

$controller =
    new BackupController();

$resultado =
    $controller->restaurarSQL(
        $_FILES['archivo_sql']['tmp_name']
    );

echo json_encode([
    'success' => $resultado
]);