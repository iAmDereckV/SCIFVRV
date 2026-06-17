<?php

require_once '../../app/controllers/CategoriaController.php';

header('Content-Type: application/json');

$controller = new CategoriaController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);
