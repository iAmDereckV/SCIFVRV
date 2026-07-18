<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
requierePermiso('reportes_ventas');
header('Content-Type: application/json');
$inicio = $_GET['inicio'];
$fin = $_GET['fin'];
$controller = new ReporteController();
echo json_encode(
    $controller->ventasPorFecha(
        $inicio,
        $fin
    )
);