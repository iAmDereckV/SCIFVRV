<?php

require_once '../../app/controllers/UsuarioController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'usuarios_ver'
);
header('Content-Type: application/json');

$controller = new UsuarioController();

echo json_encode(
    $controller->listar()
);
