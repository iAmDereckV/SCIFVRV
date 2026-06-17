<?php

require_once '../../app/controllers/GastoController.php';

header('Content-Type: application/json');

$nombreArchivo = null;


if (
    isset($_FILES['archivo_factura']) &&
    $_FILES['archivo_factura']['error'] == 0
) {

    $nombreArchivo =
        time() . '_' .
        $_FILES['archivo_factura']['name'];

    move_uploaded_file(

        $_FILES['archivo_factura']['tmp_name'],

        '../../public/uploads/gastos/' .
            $nombreArchivo
    );
}

$controller = new GastoController();

$resultado = $controller->actualizarComprobante(
    $_POST['id'],
    $nombreArchivo
);

echo json_encode([
    'success' => $resultado
]);