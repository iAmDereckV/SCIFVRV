<?php


require_once '../../app/controllers/ConfiguracionEmpresaController.php';

header('Content-Type: application/json');

$controller = new ConfiguracionEmpresaController();

echo json_encode(
    $controller->obtener()
);