<?php

require_once '../../app/controllers/GastoController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'gastos_editar'
);

$controller = new GastoController();

$controller->cgActualizar(

    $_POST['id'],

    trim($_POST['nombre'])

);

echo json_encode([
    'success' => true
]);
