<?php

require_once '../../app/controllers/ProveedorController.php';

header('Content-Type: application/json');

$controller =
    new ProveedorController();

echo json_encode(
    $controller->listar()
);
