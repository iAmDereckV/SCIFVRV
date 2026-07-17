<?php

require_once '../../app/controllers/CompraController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso('compras_anular');

$controller = new CompraController();

$resultado = $controller->anular($_GET['id']);

echo json_encode([
    'success' => $resultado
]);
