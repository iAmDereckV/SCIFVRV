<?php

require_once '../../app/controllers/bitacoraController.php';

$model = new Bitacora();

echo json_encode(
    $model->listar()
);