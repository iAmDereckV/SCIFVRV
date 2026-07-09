<?php

require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController
{
    private $dashboard;

    public function __construct()
    {
        $this->dashboard =
            new Dashboard();
    }

    public function resumen()
    {
        return $this->dashboard->resumen();
    }

    public function ventasMes()
    {
        return $this->dashboard->ventasMes();
    }

    public function productosVendidos()
    {
        return $this->dashboard->productosVendidos();
    }

    public function stockBajo()
    {
        return $this->dashboard->stockBajo();
    }
}
