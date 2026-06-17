<?php

require_once '../../app/controllers/CategoriaController.php';

header('Content-Type: application/json');

$controller = new CategoriaController();

echo json_encode(
    $controller->listar()
);
