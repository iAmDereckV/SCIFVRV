<?php

require_once '../../app/controllers/RolController.php';

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