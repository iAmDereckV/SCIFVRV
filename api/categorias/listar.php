<?php

require_once '../../app/controllers/CategoriaController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'categorias_ver'
);
header('Content-Type: application/json');

$controller = new CategoriaController();

echo json_encode(
    $controller->listar()
);
