<?php
require_once '../../app/controllers/ProductoController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('kardex_ver');
$controller = new ProductoController();
echo json_encode(
    $controller->listar()
);