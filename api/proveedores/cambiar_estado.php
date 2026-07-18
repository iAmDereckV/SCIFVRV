<?php
require_once '../../app/controllers/ProveedorController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('proveedores_eliminar');
$controller = new ProveedorController();
$resultado = $controller->cambiarEstado(
    $_POST['id'],
    $_POST['estado']
);
echo json_encode([
    'success' => $resultado
]);