<?php
require_once '../../app/controllers/UsuarioController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('usuarios_eliminar');
header('Content-Type: application/json');
$controller = new UsuarioController();
$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);
echo json_encode([
    'success' => $resultado
]);