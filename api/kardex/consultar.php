<?php

require_once '../../app/controllers/KardexController.php';

$controller = new KardexController();

echo json_encode(

    $controller->consultar(
        $_GET['producto_id']
    )

);