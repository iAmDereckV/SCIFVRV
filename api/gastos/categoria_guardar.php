<?php

require_once '../../app/controllers/GastoController.php';


$controller = new GastoController();

$id = $controller->cgGuardar(
    trim($_POST['nombre'])
);

echo json_encode([
    'success' => true,
    'id' => $id
]);
