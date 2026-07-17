<?php

require_once '../../app/controllers/ProveedorController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'proveedores_ver'
);
header('Content-Type: application/json');

$controller =
    new ProveedorController();

echo json_encode(
    $controller->obtener(
        $_GET['id']
    )
);
