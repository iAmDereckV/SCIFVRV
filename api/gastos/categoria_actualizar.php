<?php

require_once '../../app/controllers/GastoController.php';


$controller = new GastoController();

$controller->cgActualizar(

    $_POST['id'],

    trim($_POST['nombre'])

);

echo json_encode([
    'success' => true
]);
