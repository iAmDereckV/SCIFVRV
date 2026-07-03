<?php
require_once '../../app/controllers/BackupController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('backup_reiniciar');

$controller = new BackupController();

$resultado = $controller->reiniciar();

echo json_encode([
    'success' => $resultado
]);