<?php
require_once '../../app/controllers/MaestroDetalleController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('reportes_detalle_maestro');
$controller = new MaestroDetalleController();
$anio = $_GET['anio'] ?? date('Y');
echo json_encode(
    $controller->obtenerResumen(
        $anio
    )
);