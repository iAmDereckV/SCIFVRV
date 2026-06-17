<?php

require_once '../../app/controllers/CategoriaController.php';

header('Content-Type: application/json');

$controller = new CategoriaController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);
