<?php

require_once '../../app/controllers/GastoController.php';

header('Content-Type: application/json');

$controller = new GastoController();

echo json_encode(
    $controller->obtenerCategorias()
);