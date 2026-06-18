<?php

require_once '../../app/controllers/MarcaController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'marcas_crear'
);
header('Content-Type: application/json');

$controller = new MarcaController();

$resultado = $controller->guardar(
    $_POST['nombre'],
    $_POST['descripcion']
);

echo json_encode([
    'success' => $resultado
]);