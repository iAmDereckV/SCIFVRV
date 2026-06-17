<?php

require_once '../../app/controllers/RolController.php';

header('Content-Type: application/json');

$controller = new RolController();

echo json_encode(
    $controller->listar()
);
