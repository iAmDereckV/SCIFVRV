<?php

require_once '../../app/controllers/RolController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'roles_ver'
);
$controller =
    new RolController();

echo json_encode(
    $controller->obtenerPermisos(
        $_GET['id']
    )
);
