<?php

require_once '../../app/controllers/RolController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'roles_editar'
);
header(
    'Content-Type: application/json'
);

$controller =
    new RolController();

$permisos =
    $_POST['permisos']
    ??
    [];

$resultado =
    $controller->guardarPermisos(
        $_POST['rol_id'],
        $permisos
    );

echo json_encode([
    'success' => $resultado
]);