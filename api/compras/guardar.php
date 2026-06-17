<?php

require_once '../../app/controllers/CompraController.php';
require_once '../../app/helpers/Session.php';

header('Content-Type: application/json');

Session::iniciar();
$archivoFactura = null;

if (
    isset($_FILES['archivo_factura'])
    &&
    $_FILES['archivo_factura']['error'] == 0
) {

    $extension =
        pathinfo(
            $_FILES['archivo_factura']['name'],
            PATHINFO_EXTENSION
        );

    $nombreArchivo =
        'factura_'
        .
        time()
        .
        '.'
        .
        $extension;

    move_uploaded_file(

        $_FILES['archivo_factura']['tmp_name'],

        '../../public/uploads/facturas/'
            .
            $nombreArchivo

    );

    $archivoFactura =
        'uploads/facturas/'
        .
        $nombreArchivo;
}
$controller =
    new CompraController();

$productos =
    json_decode(
        $_POST['productos'],
        true
    );


$resultado =
    $controller->guardar(
        $_POST['proveedor_id'],
        Session::get('usuario_id'),
        $_POST['factura'],
        $archivoFactura,
        $productos,
        $_POST['total']
    );
echo json_encode([
    'success' => $resultado
]);