<?php

require_once '../../app/controllers/RolController.php';

$controller = new RolController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);
