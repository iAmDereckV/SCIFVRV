<?php
require_once '../../app/controllers/ProductoController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('productos_ver');
header('Content-Type: application/json');
$controller = new ProductoController();
echo json_encode(
    $controller->marcas()
);