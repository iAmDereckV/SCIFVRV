<?php


require_once '../../app/controllers/MaestroDetalleController.php';

$controller =
    new MaestroDetalleController();

echo json_encode(
    $controller->obtenerAnios()
);