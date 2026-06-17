<?php

require_once '../../app/controllers/VentaController.php';

$controller =
    new VentaController();

$resultado =
    $controller->anular(
        $_GET['id']
    );

echo json_encode([
    'success' => $resultado
]);