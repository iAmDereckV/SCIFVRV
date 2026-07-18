<?php
require_once '../../app/controllers/ConfiguracionEmpresaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('empresa_configurar');
$controller = new ConfiguracionEmpresaController();
$logo = null;
if (
    isset($_FILES['logo']) &&
    $_FILES['logo']['error'] == 0
) {
    $extension = pathinfo(
        $_FILES['logo']['name'],
        PATHINFO_EXTENSION
    );
    $nombreArchivo = 'logo_empresa.' . $extension;

    move_uploaded_file(

        $_FILES['logo']['tmp_name'],

        '../../public/uploads/empresa/' . $nombreArchivo
    );
    $logo = $nombreArchivo;
} else {
    $empresa = $controller->obtener();
    $logo = $empresa['logo'];
}

try {
    $resultado = $controller->actualizar(
        $_POST['nombre'],
        $_POST['ruc'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['direccion'],
        $_POST['slogan'],
        $logo,
    );
    echo json_encode([
        'success' => $resultado
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}