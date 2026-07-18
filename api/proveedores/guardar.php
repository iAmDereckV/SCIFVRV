<?php
require_once '../../app/controllers/ProveedorController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('proveedores_crear');
$controller = new ProveedorController();
$resultado = $controller->guardar(
    $_POST['nombre'],
    $_POST['contacto'],
    $_POST['telefono'],
    $_POST['correo'],
    $_POST['direccion']
);
echo json_encode([
    'success' => $resultado
]);