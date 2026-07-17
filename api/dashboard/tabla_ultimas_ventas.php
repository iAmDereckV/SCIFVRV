<?php

require_once '../../app/controllers/DashboardController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso('dashboard_ver');
header('Content-Type: application/json');

$controller = new DashboardController();

echo json_encode(

    $controller->ultimasVentas()

);
