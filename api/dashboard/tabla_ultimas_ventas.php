<?php

require_once '../../app/controllers/DashboardController.php';

header('Content-Type: application/json');

$controller = new DashboardController();

echo json_encode(

    $controller->ultimasVentas()

);