<?php

require_once __DIR__ . '/../models/Reporte.php';

class ReporteController
{
    private $reporte;

    public function __construct()
    {
        $this->reporte =
            new Reporte();
    }

    public function ventasPorFecha(
        $inicio,
        $fin
    ) {
        return $this->reporte
            ->ventasPorFecha(
                $inicio,
                $fin
            );
    }
    public function comprasPorFecha(
        $inicio,
        $fin
    ) {

        return $this->reporte
            ->comprasPorFecha(
                $inicio,
                $fin
            );
    }
    public function gastosPorFecha(
        $inicio,
        $fin
    ) {

        return $this->reporte
            ->gastosPorFecha(
                $inicio,
                $fin
            );
    }
}