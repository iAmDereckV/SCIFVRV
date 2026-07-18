<?php
require_once '../../app/controllers/VentaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('ventas_crear');
header('Content-Type: application/json');
$controller = new VentaController();
echo json_encode(
    $controller->productos()
);