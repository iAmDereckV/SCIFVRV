<?php

require_once __DIR__ . '/../models/Gasto.php';

class GastoController
{
    private $gasto;

    public function __construct()
    {
        $this->gasto = new Gasto();
    }

    public function listar()
    {
        return $this->gasto->listar();
    }
    public function reporteGastos()
    {
        return $this->gasto->reporteGastos();
    }

    public function guardar(
        $categoria,
        $descripcion,
        $monto,
        $fecha,
        $usuario_id,
        $archivo
    ) {
        return $this->gasto->guardar(
            $categoria,
            $descripcion,
            $monto,
            $fecha,
            $usuario_id,
            $archivo
        );
    }
    public function obtenerCategorias()
    {
        return $this->gasto
            ->obtenerCategorias();
    }
    public function obtenerPorId($id)
    {
        return $this->gasto
            ->obtenerPorId($id);
    }
    public function actualizarComprobante(
        $id,
        $archivo
    ) {
        return $this->gasto
            ->actualizarComprobante(
                $id,
                $archivo
            );
    }
    public function actualizar(
        $id,
        $categoria_id,
        $descripcion,
        $monto,
        $fecha
    ) {
        return $this->gasto
            ->actualizar(
                $id,
                $categoria_id,
                $descripcion,
                $monto,
                $fecha
            );
    }
}