<?php
require_once '../../app/controllers/CategoriaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso(
    'categorias_crear'
);
header('Content-Type: application/json');
$controller = new CategoriaController();
$resultado = $controller->guardar(
    $_POST['nombre'],
    $_POST['descripcion']
);
echo json_encode([
    'success' => $resultado
]);