<?php

require_once '../../app/controllers/UsuarioController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'usuarios_crear'
);
$controller = new UsuarioController();
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
        '../../public/uploads/usuarios/' .
            $nombreImagen
    );
}
$resultado = $controller->guardar(
    $_POST['rol_id'],
    $_POST['nombre'],
    $_POST['usuario'],
    $_POST['correo'],
    $_POST['password'],
    $nombreImagen
);

echo json_encode([
    'success' => $resultado
]);