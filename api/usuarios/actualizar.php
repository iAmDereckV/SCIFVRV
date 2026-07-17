<?php

require_once '../../app/controllers/UsuarioController.php';

require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'usuarios_editar'
);
header('Content-Type: application/json');
$controller = new UsuarioController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['rol_id'],
    $_POST['nombre'],
    $_POST['usuario'],
    $_POST['correo']
);

echo json_encode([
    'success' => $resultado
]);
