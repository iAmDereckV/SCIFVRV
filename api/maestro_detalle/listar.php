<?php

require_once '../../app/controllers/MaestroDetalleController.php';

$controller =
    new MaestroDetalleController();
$anio =
    $_GET['anio']
    ??
    date('Y');


$anio =
    $_GET['anio']
    ??
    date('Y');

echo json_encode(
    $controller->obtenerResumen(
        $anio
    )
);