<?php


require_once __DIR__ . '/../config/database.php';

class MaestroDetalle
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();

        $this->conexion =
            $db->conectar();
    }

    public function obtenerResumen($anio)
    {
        $ventas =
            $this->obtenerVentas($anio);

        $compras =
            $this->obtenerCompras($anio);

        $gastos =
            $this->obtenerGastos($anio);

        $resultado = [];

        $resultado[] =
            $this->crearFila(
                'Ventas',
                $ventas
            );

        $resultado[] =
            $this->crearFila(
                'Compras',
                $compras
            );

        $resultado[] =
            $this->crearFila(
                'Gastos',
                $gastos
            );
        $utilidadBruta =
            $this->calcularUtilidadBruta(
                $ventas,
                $compras
            );

        $resultado[] =
            $this->crearFila(
                'Utilidad Bruta',
                $utilidadBruta
            );

        $utilidadNeta =
            $this->calcularUtilidadNeta(
                $utilidadBruta,
                $gastos
            );

        $resultado[] =
            $this->crearFila(
                'Utilidad Neta',
                $utilidadNeta
            );
        return $resultado;
    }

    private function obtenerVentas($anio)
    {
        $sql = "

        SELECT
    MONTH(fecha) mes,
    SUM(total) total
FROM ventas
WHERE estado='COMPLETADA'
AND YEAR(fecha)=?
GROUP BY MONTH(fecha)

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([$anio]);

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    private function obtenerCompras($anio)
    {
        $sql = "

SELECT
    MONTH(fecha) mes,
    SUM(total) total
FROM compras
WHERE YEAR(fecha)=?
GROUP BY MONTH(fecha)
        
    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([$anio]);

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    private function obtenerGastos($anio)
    {
        $sql = "

SELECT
    MONTH(fecha) mes,
    SUM(monto) total
FROM gastos
WHERE YEAR(fecha)=?
GROUP BY MONTH(fecha)

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute([$anio]);

        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    }
    private function crearFila(
        $concepto,
        $datos
    ) {

        $fila = [

            'concepto' => $concepto,

            'enero' => 0,
            'febrero' => 0,
            'marzo' => 0,
            'abril' => 0,
            'mayo' => 0,
            'junio' => 0,
            'julio' => 0,
            'agosto' => 0,
            'septiembre' => 0,
            'octubre' => 0,
            'noviembre' => 0,
            'diciembre' => 0,

            'total' => 0

        ];

        $meses = [

            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre'

        ];

        foreach ($datos as $mes => $valor) {

            $nombreMes =
                $meses[$mes];

            $fila[$nombreMes] =
                $valor;

            $fila['total'] +=
                $valor;
        }

        return $fila;
    }
    private function calcularUtilidadBruta(
        $ventas,
        $compras
    ) {

        $resultado = [];

        for ($mes = 1; $mes <= 12; $mes++) {

            $venta =
                $ventas[$mes] ?? 0;

            $compra =
                $compras[$mes] ?? 0;

            $resultado[$mes] =
                $venta - $compra;
        }

        return $resultado;
    }
    private function calcularUtilidadNeta(
        $utilidadBruta,
        $gastos
    ) {

        $resultado = [];

        for ($mes = 1; $mes <= 12; $mes++) {

            $bruta =
                $utilidadBruta[$mes] ?? 0;

            $gasto =
                $gastos[$mes] ?? 0;

            $resultado[$mes] =
                $bruta - $gasto;
        }

        return $resultado;
    }
    public function obtenerAnios()
    {
        $sql = "

    SELECT DISTINCT anio

    FROM (

        SELECT YEAR(fecha) anio
        FROM ventas

        UNION

        SELECT YEAR(fecha)
        FROM compras

        UNION

        SELECT YEAR(fecha)
        FROM gastos

    ) t

    ORDER BY anio DESC

    ";

        $stmt =
            $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(
            PDO::FETCH_COLUMN
        );
    }
}