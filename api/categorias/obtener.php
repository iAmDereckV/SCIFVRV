<?php

require_once '../../app/controllers/CategoriaController.php';
require_once '../../app/helpers/permisos.php';
requierePermiso(
    'categorias_ver'
);
header('Content-Type: application/json');

$controller = new CategoriaController();

echo json_encode(
    $controller->obtenerPorId(
        $_GET['id']
    )
);
