<?php

require_once '../../app/controllers/ProveedorController.php';

$resultado =
    (
        new ProveedorController()
    )
    ->cambiarEstado(

        $_POST['id'],

        $_POST['estado']
    );

echo json_encode([
    'success' => $resultado
]);
