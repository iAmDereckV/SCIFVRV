<?php

require_once '../../app/controllers/VentaController.php';

header('Content-Type: application/json');

$controller = new VentaController();

$detalle =
    json_decode(
        $_POST['detalle'],
        true
    );

$resultado = $controller->guardar(
    $_POST['cliente_id'],
    $_POST['usuario_id'],
    $_POST['subtotal'],
    $_POST['impuesto'],
    $_POST['descuento'],
    $_POST['total'],
    $detalle
);

echo json_encode([
    'success' => $resultado ? true : false,
    'venta_id' => $resultado
]);