<?php

require_once '../../app/controllers/ProveedorController.php';

$resultado =
    (
        new ProveedorController()
    )
    ->actualizar(

        $_POST['id'],

        $_POST['nombre'],

        $_POST['contacto'],

        $_POST['telefono'],

        $_POST['correo'],

        $_POST['direccion']
    );

echo json_encode([
    'success' => $resultado
]);
