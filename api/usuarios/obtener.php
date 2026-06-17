<?php

require_once '../../app/controllers/UsuarioController.php';

header('Content-Type: application/json');

$controller = new UsuarioController();

echo json_encode(
    $controller->obtenerPorId(
        $_GET['id']
    )
);
