<?php
require_once '../../app/controllers/KardexController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('kardex_ver');
header('Content-Type: application/json');
$controller = new KardexController();
echo json_encode(
    $controller->obtenerProducto(
        $_GET['id']
    )
);