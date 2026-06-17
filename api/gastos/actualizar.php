<?php

require_once '../../app/controllers/GastoController.php';

$controller =
    new GastoController();

$resultado =
    $controller->actualizar(

        $_POST['id'],

        $_POST['categoria_id'],

        $_POST['descripcion'],

        $_POST['monto'],

        $_POST['fecha']

    );

echo json_encode([
    'success' => $resultado
]);