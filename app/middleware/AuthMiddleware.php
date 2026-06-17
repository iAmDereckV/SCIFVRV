<?php

require_once __DIR__ . '/../helpers/Session.php';
require_once __DIR__ . '/../config/config.php';

class AuthMiddleware
{
    public static function verificar()
    {
        Session::iniciar();

        if (!Session::existe('usuario_id')) {
            header('Location:' . constant("APP_URL") . '/public/login.php');
            exit;
        }
    }
}