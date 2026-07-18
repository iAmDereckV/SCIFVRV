<?php
require_once '../../app/controllers/VentaController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('ventas_anular');
$controller = new VentaController();
$resultado = $controller->anular(
    $_GET['id']
);
echo json_encode([
    'success' => $resultado
]);