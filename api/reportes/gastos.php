<?php

require_once '../../app/controllers/ReporteController.php';

header(
    'Content-Type: application/json'
);

$controller =
    new ReporteController();

echo json_encode(

    $controller->gastosPorFecha(

        $_GET['inicio'],

        $_GET['fin']

    )

);