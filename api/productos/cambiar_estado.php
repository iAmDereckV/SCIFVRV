<?php

require_once '../../app/controllers/ProductoController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'productos_eliminar'
);
header('Content-Type: application/json');

$controller = new ProductoController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);