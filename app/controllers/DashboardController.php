<?php

require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController
{
    private $dashboard;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    public function resumen()
    {
        return $this->dashboard->resumen();
    }

    public function ventasComprasMes()
    {
        return $this->dashboard->ventasComprasMes();
    }

    public function productosVendidos()
    {
        return $this->dashboard->productosVendidos();
    }

    public function stockBajo()
    {
        return $this->dashboard->stockBajo();
    }
    public function ventasPorVendedor()
    {
        return $this->dashboard->ventasPorVendedor();
    }
    public function resumenFinanciero()
    {
        return $this->dashboard->resumenFinanciero();
    }
    public function stockBajoTabla()
    {
        return $this->dashboard->stockBajoTabla();
    }

    public function ultimasVentas()
    {
        return $this->dashboard->ultimasVentas();
    }

    public function ultimasCompras()
    {
        return $this->dashboard->ultimasCompras();
    }

    public function actividadReciente()
    {
        return $this->dashboard->actividadReciente();
    }
}