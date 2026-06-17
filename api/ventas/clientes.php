<?php

require_once '../../app/controllers/VentaController.php';

header('Content-Type: application/json');

$controller = new VentaController();

echo json_encode(
    $controller->clientes()
);