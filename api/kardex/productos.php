<?php


require_once '../../app/controllers/ProductoController.php';


$controller = new ProductoController();

echo json_encode(
    $controller->listar()
);