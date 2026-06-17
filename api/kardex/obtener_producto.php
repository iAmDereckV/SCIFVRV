<?php

require_once '../../app/controllers/KardexController.php';

header('Content-Type: application/json');

$controller = new KardexController();

echo json_encode(
    $controller->obtenerProducto(
        $_GET['id']
    )
);