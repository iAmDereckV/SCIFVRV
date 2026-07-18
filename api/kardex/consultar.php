<?php
require_once '../../app/controllers/KardexController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('kardex_ver');
$controller = new KardexController();
echo json_encode(
    $controller->consultar(
        $_GET['producto_id']
    )
);