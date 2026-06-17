<?php

require_once '../../app/controllers/RolController.php';

$controller =
    new RolController();

echo json_encode(
    $controller->obtenerPermisos(
        $_GET['id']
    )
);