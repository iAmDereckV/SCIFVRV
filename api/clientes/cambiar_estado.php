<?php

require_once '../../app/controllers/ClienteController.php';
require_once '../../app/helpers/permisos.php';
requierePermiso(
    'clientes_eliminar'
);

header('Content-Type: application/json');

$controller = new ClienteController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);