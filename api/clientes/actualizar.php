<?php
require_once '../../app/controllers/ClienteController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('clientes_editar');
header('Content-Type: application/json');
$controller = new ClienteController();
$resultado = $controller->actualizar(
    $_POST['id'],
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