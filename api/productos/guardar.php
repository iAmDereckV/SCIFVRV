<?php

require_once '../../app/controllers/ProductoController.php';

header('Content-Type: application/json');

$controller = new ProductoController();
$nombreImagen = null;

if (
    isset($_FILES['imagen']) &&
    $_FILES['imagen']['error'] == 0
) {

    $nombreImagen =
        time() . '_' .
        $_FILES['imagen']['name'];

    move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        '../../public/uploads/productos/' .
            $nombreImagen
    );
}
$resultado = $controller->guardar(
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
    $_POST['ubicacion'],
    $nombreImagen
);

echo json_encode([
    'success' => $resultado
]);