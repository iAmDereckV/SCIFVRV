<?php

require_once '../../app/controllers/RolController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'roles_editar'
);
$controller = new RolController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);