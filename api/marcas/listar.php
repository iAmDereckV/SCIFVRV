<?php
require_once '../../app/controllers/MarcaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('marcas_ver');
header('Content-Type: application/json');
$controller = new MarcaController();
echo json_encode(
    $controller->listar()
);