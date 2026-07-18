<?php
require_once '../../app/controllers/GastoController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('gastos_editar');
header('Content-Type: application/json');
$nombreArchivo = null;
if (
    isset($_FILES['imagen']) &&
    $_FILES['imagen']['error'] == 0
) {
    $nombreArchivo = time() . '_' . $_FILES['imagen']['name'];
    move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        '../../public/uploads/gastos/' . $nombreArchivo
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