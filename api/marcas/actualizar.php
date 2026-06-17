<?php

require_once '../../app/controllers/MarcaController.php';

header('Content-Type: application/json');

$controller = new MarcaController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);
