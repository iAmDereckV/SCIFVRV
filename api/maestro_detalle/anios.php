<?php
require_once '../../app/controllers/MaestroDetalleController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('reportes_detalle_maestro');
$controller = new MaestroDetalleController();
echo json_encode(
    $controller->obtenerAnios()
);