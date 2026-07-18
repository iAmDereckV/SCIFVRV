<?php
require_once '../../app/controllers/ProductoController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('productos_editar');
$nombreImagen = null;
if (
    isset($_FILES['imagen']) &&
    $_FILES['imagen']['error'] == 0
) {
    $nombreImagen = time() . '_' . $_FILES['imagen']['name'];
    move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        '../../public/uploads/productos/' . $nombreImagen
    );
}
$controller = new ProductoController();
$resultado = $controller->actualizarImagen(
    $_POST['id'],
    $nombreImagen
);
echo json_encode([
    'success' => $resultado
]);