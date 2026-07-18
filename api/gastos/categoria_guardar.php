<?php
require_once '../../app/controllers/GastoController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('gastos_crear');
$controller = new GastoController();
$id = $controller->cgGuardar(
    trim($_POST['nombre'])
);
echo json_encode([
    'success' => true,
    'id' => $id
]);