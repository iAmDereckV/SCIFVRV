<?php

require_once '../../app/controllers/CompraController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso('compras_editar');

header('Content-Type: application/json');

$nombreArchivo = null;

if (
    isset($_FILES['archivo_factura']) &&
    $_FILES['archivo_factura']['error'] == 0
) {

    $extension = pathinfo(
        $_FILES['archivo_factura']['name'],
        PATHINFO_EXTENSION
    );

    $nombreArchivo =
        'factura_' .
        time() .
        '.' .
        $extension;

    move_uploaded_file(
        $_FILES['archivo_factura']['tmp_name'],
        '../../public/uploads/facturas/' . $nombreArchivo
    );

    $nombreArchivo =
        'uploads/facturas/' . $nombreArchivo;
}

$controller = new CompraController();

$resultado = $controller->actualizarComprobante(
    $_POST['id'],
    $nombreArchivo
);

echo json_encode([
    'success' => $resultado
]);
