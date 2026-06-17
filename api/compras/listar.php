<?php

require_once '../../app/controllers/CompraController.php';

header('Content-Type: application/json');

$controller =
    new CompraController();

echo json_encode(
    $controller->listar()
);
