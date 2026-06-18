<?php

require_once '../../app/controllers/UsuarioController.php';

header('Content-Type: application/json');
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'usuarios_eliminar'
);
$controller = new UsuarioController();

$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);

echo json_encode([
    'success' => $resultado
]);