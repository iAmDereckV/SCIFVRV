<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../helpers/Session.php';
require_once __DIR__ . '/../helpers/Security.php';


class AuthController
{
    public function login($usuario, $password)
    {
        $usuarioModel = new Usuario();
        $datos = $usuarioModel->buscarPorUsuario($usuario);
        if (!$datos) {
            return [
                'success' => false,
                'mensaje' => 'Usuario no encontrado'
            ];
        }
        if (!Security::verifyPassword($password, $datos['password']))
        // if ($password != $datos['password'])
        {
            return [
                'success' => false,
                'mensaje' => 'Contraseña incorrecta'
            ];
        }
        $usuarioModel->actualizarUltimoAcceso(
            $datos['id']
        );
        $permisos =
            $usuarioModel->obtenerPermisos(
                $datos['rol_id']
            );
        Session::iniciar();
        Session::set('usuario_id', $datos['id']);
        Session::set('usuario', $datos['usuario']);
        Session::set('nombre', $datos['nombre']);
        Session::set('rol', $datos['rol_id']);
        Session::set('rol_nombre', $datos['rol_nombre']);
        Session::set('permisos', $permisos);

        Session::set('ufoto', $datos['foto']);
        return [
            'success' => true
        ];
    }

    public function logout()
    {
        Session::iniciar();
        Session::destruir();
        return true;
    }
}