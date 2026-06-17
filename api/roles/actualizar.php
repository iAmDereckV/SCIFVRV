<?php

require_once '../../app/controllers/RolController.php';

$controller = new RolController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);
