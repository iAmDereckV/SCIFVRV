<?php

require_once '../../app/controllers/ClienteController.php';
require_once '../../app/helpers/permisos.php';
requierePermiso(
    'clientes_ver'
);
header('Content-Type: application/json');

$controller = new ClienteController();

echo json_encode(
    $controller->obtenerTiposCliente()
);
