<?php

require_once '../../app/controllers/GastoController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'gastos_crear'
);
$controller = new GastoController();
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
$resultado = $controller->guardar(
    $_POST['categoria_id'],
    $_POST['descripcion'],
    $_POST['monto'],
    $_POST['fecha'],
    $_SESSION['usuario_id'],
    $nombreArchivo
);

echo json_encode([
    'success' => $resultado
]);
