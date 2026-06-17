<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function listar()
    {
        return $this->cliente->listar();
    }

    public function guardar(
        $nombres,
        $apellidos,
        $telefono,
        $correo,
        $direccion,
        $identificacion,
        $tipo_cliente
    ) {
        return $this->cliente->guardar(
            $nombres,
            $apellidos,
            $telefono,
            $correo,
            $direccion,
            $identificacion,
            $tipo_cliente
        );
    }

    public function obtenerPorId($id)
    {
        return $this->cliente->obtenerPorId($id);
    }

    public function actualizar(
        $id,
        $nombres,
        $apellidos,
        $telefono,
        $correo,
        $direccion,
        $identificacion,
        $tipo_cliente
    ) {
        return $this->cliente->actualizar(
            $id,
            $nombres,
            $apellidos,
            $telefono,
            $correo,
            $direccion,
            $identificacion,
            $tipo_cliente
        );
    }

    public function cambiarEstado(
        $id,
        $estado
    ) {
        return $this->cliente->cambiarEstado(
            $id,
            $estado
        );
    }
}
