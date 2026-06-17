<?php

require_once '../../app/controllers/ClienteController.php';

header('Content-Type: application/json');

$controller = new ClienteController();

echo json_encode(
    $controller->obtenerPorId(
        $_GET['id']
    )
);
