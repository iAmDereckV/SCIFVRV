<?php

require_once '../../app/controllers/CompraController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso('compras_ver');
header('Content-Type: application/json');

$controller =
    new CompraController();

echo json_encode(
    $controller->obtenerProductos()
);
