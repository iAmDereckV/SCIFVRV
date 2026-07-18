<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
requierePermiso('reportes_gastos');
header('Content-Type: application/json');
$controller = new ReporteController();
echo json_encode(
    $controller->gastosPorFecha(
        $_GET['inicio'],
        $_GET['fin']
    )
);