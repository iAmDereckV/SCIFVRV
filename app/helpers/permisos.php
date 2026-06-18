<?php

require_once __DIR__ . '/Session.php';

function tienePermiso($permiso)
{
    Session::iniciar();

    return in_array(
        $permiso,
        $_SESSION['permisos']
            ??
            []
    );
}
function requierePermiso($permiso)
{
    Session::iniciar();

    if (
        !in_array(
            $permiso,
            $_SESSION['permisos']
                ??
                []
        )
    ) {

        header(
            'Content-Type: application/json'
        );

        echo json_encode([
            'success' => false,
            'mensaje' => 'Acceso denegado'
        ]);

        exit;
    }
}