<?php

require_once '../../app/controllers/MarcaController.php';

header('Content-Type: application/json');

$controller = new MarcaController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);
