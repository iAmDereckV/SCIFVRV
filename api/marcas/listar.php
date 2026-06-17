<?php

require_once '../../app/controllers/MarcaController.php';

header('Content-Type: application/json');

$controller = new MarcaController();

echo json_encode(
    $controller->listar()
);
