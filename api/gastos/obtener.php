<?php

require_once '../../app/controllers/GastoController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'gastos_ver'
);
header('Content-Type: application/json');

$controller =
    new GastoController();

echo json_encode(
    $controller->obtenerPorId(
        $_GET['id']
    )
);
