<?php

require_once '../../app/controllers/bitacoraController.php';
require_once '../../app/helpers/Permisos.php';

requierePermiso(
    'bitacora_ver'
);
$model = new Bitacora();

echo json_encode(
    $model->listar()
);