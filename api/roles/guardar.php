<?php

require_once '../../app/controllers/RolController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'roles_crear'
);
$controller = new RolController();

$resultado = $controller->guardar(
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);