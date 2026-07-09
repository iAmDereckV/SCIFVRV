<?php

require_once __DIR__ . '/../helpers/Session.php';
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthMiddleware
{
    public static function verificar()
    {
        Session::iniciar();

        if (!Session::existe('usuario_id')) {

            header('Location:' . constant("APP_URL") . '/public/login.php');
            exit;
        }

        $usuarioModel = new Usuario();

        $usuario = $usuarioModel->verificarSesion(
            Session::get('usuario_id')
        );

        if (
            !$usuario ||
            $usuario['estado'] !== 'ACTIVO' ||
            $usuario['rol_estado'] !== 'ACTIVO'
        ) {

            Session::destruir();

            header('Location:' . constant("APP_URL") . '/public/login.php');
            exit;
        }
    }
}
