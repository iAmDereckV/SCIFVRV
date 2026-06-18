<?php

require_once '../../app/controllers/ClienteController.php';
require_once '../../app/helpers/permisos.php';
requierePermiso(
    'clientes_crear'
);
header('Content-Type: application/json');

$controller = new ClienteController();

$resultado = $controller->guardar(
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['telefono'],
    $_POST['correo'],
    $_POST['direccion'],
    $_POST['identificacion'],
    $_POST['tipo_cliente']
);

echo json_encode([
    'success' => $resultado
]);