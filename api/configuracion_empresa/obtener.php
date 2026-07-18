<?php
require_once '../../app/controllers/ConfiguracionEmpresaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('empresa_configurar');
header('Content-Type: application/json');
$controller = new ConfiguracionEmpresaController();
echo json_encode(
    $controller->obtener()
);