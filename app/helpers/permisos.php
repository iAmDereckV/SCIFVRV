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