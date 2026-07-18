<?php
require_once '../../app/controllers/RolController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('roles_eliminar');
$controller = new RolController();
$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);
echo json_encode([
    'success' => $resultado
]);