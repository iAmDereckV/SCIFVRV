<?php

require_once '../../app/controllers/ProductoController.php';

header('Content-Type: application/json');

$controller = new ProductoController();

$resultado = $controller->actualizar(
    $_POST['id'],
    $_POST['codigo'],
    $_POST['categoria_id'],
    $_POST['marca_id'],
    $_POST['nombre'],
    $_POST['descripcion'],
    $_POST['vehiculo_aplicable'],
    $_POST['precio_compra'],
    $_POST['precio_venta'],
    $_POST['stock'],
    $_POST['stock_minimo'],
    $_POST['ubicacion']
);

echo json_encode([
    'success' => $resultado
]);
