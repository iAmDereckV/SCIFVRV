<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/VentaController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new VentaController();

$ventas = $controller->reporteVentas();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=ventas.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>Factura</th>

    <th>Fecha</th>

    <th>Cliente</th>

    <th>Total</th>

    <th>Estado</th>

</tr>

";
$totalVentas = 0;

foreach ($ventas as $venta) {

    if (
        $venta['estado'] !== 'ANULADA'
    ) {
        $totalVentas +=
            $venta['total'];
    }

    echo "

    <tr>

        <td>{$venta['id']}</td>

        <td>{$venta['fecha']}</td>

        <td>{$venta['cliente']}</td>

        <td>{$venta['total']}</td>

        <td>{$venta['estado']}</td>

    </tr>

    ";
}
echo "

<tr>

    <td colspan='3'>

        TOTAL VENTAS

    </td>

    <td>

        {$totalVentas}

    </td>

    <td></td>

</tr>

";
echo "</table>";
