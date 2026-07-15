<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/VentaController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new VentaController();

$datos =
    $controller->reporteVentasDetalladas();

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=ventas_detalladas.xls"
);

header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>Factura</th>

    <th>Fecha</th>

    <th>Cliente</th>

    <th>Código</th>

    <th>Producto</th>

    <th>Cantidad</th>

    <th>Costo</th>
    <th>Precio</th>

    <th>Subtotal</th>

    <th>Estado</th>

</tr>

";
$totalCantidad = 0;
$totalCosto = 0;
$totalPrecio = 0;
$totalGeneral = 0;

foreach ($datos as $fila) {

    if (
        $fila['estado']
        !== 'ANULADA'
    ) {

        $totalCantidad +=
            $fila['cantidad'];
        $totalCosto +=
            $fila['costo_unitario'];
        $totalPrecio +=
            $fila['precio_unitario'];
        $totalGeneral +=
            $fila['cantidad'];
    }

    echo "

    <tr>

        <td>{$fila['factura']}</td>

        <td>{$fila['fecha']}</td>

        <td>{$fila['cliente']}</td>

        <td>{$fila['codigo']}</td>

        <td>{$fila['producto']}</td>

        <td>{$fila['cantidad']}</td>

        <td>{$fila['costo_unitario']}</td>
        <td>{$fila['precio_unitario']}</td>

        <td>{$fila['subtotal']}</td>

        <td>{$fila['estado']}</td>

    </tr>

    ";
}
echo "

<tr>

    <td colspan='5'>

        TOTAL GENERAL

    </td>

    <td>

        {$totalCantidad}

    </td>
    <td>

        {$totalCosto}

    </td>
    <td>

        {$totalPrecio}

    </td>
    <td>

        {$totalGeneral}

    </td>

    <td></td>

</tr>

";
echo "</table>";
