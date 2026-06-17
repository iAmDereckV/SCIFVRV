<?php

require_once '../../app/controllers/BackupController.php';

$controller =
    new BackupController();

echo json_encode(
    $controller->listarRespaldos()
);
