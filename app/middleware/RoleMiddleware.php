<?php

require_once __DIR__ . '/../helpers/Session.php';

class RoleMiddleware
{
    public static function verificar($rolPermitido)
    {
        Session::iniciar();
        $rol = Session::get('rol');
        if ($rol !== $rolPermitido) {
            die('Acceso denegado');
        }
    }
}