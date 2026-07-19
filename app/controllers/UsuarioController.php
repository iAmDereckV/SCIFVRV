<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../helpers/Security.php';

class UsuarioController
{
    private $usuario;
    private $security;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $this->security = new Security();
    }

    public function listar()
    {
        return $this->usuario->listar();
    }

    public function roles()
    {
        return $this->usuario->obtenerRoles();
    }

    public function guardar(
        $rol_id,
        $nombre,
        $usuario,
        $correo,
        $password,
        $nombreImagen
    ) {
        $password = $this->security->hashPassword($password);
        return $this->usuario->guardar(
            $rol_id,
            $nombre,
            $usuario,
            $correo,
            $password,
            $nombreImagen
        );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->usuario->cambiarEstado(
            $id,
            $estado
        );
    }
    public function obtenerPorId($id)
    {
        return $this->usuario->obtenerPorId($id);
    }

    public function actualizar(
        $id,
        $rol_id,
        $nombre,
        $usuario,
        $correo
    ) {
        return $this->usuario->actualizar(
            $id,
            $rol_id,
            $nombre,
            $usuario,
            $correo
        );
    }
    public function actualizarFoto(
        $id,
        $foto
    ) {
        return $this->usuario->actualizarFoto(
            $id,
            $foto
        );
    }
    public function obtenerPermisos($rol_id)
    {
        return $this->usuario->obtenerPermisos($rol_id);
    }
}