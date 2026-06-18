<?php

require_once '../../app/controllers/BackupController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'backup_ver'
);
$controller =
    new BackupController();

echo json_encode(
    $controller->listarRespaldos()
);