<?php

require_once '../../app/controllers/ProductoController.php';

header('Content-Type: application/json');

$controller = new ProductoController();

echo json_encode(
    $controller->obtenerPorId(
        $_GET['id']
    )
);
