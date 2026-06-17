<?php

require_once '../../app/controllers/BackupController.php';

header('Content-Type: application/json');

$controller =
    new BackupController();

$resultado =
    $controller->restaurarZip(
        $_FILES['archivo_zip']['tmp_name']
    );

echo json_encode([
    'success' => $resultado
]);