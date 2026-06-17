<?php

require_once '../../app/controllers/ReporteController.php';

header(
    'Content-Type: application/json'
);

$controller =
    new ReporteController();

echo json_encode(

    $controller->comprasPorFecha(

        $_GET['inicio'],

        $_GET['fin']

    )

);