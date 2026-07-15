<?php

require_once '../../app/helpers/Permisos.php';

require_once '../../app/controllers/CompraController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new CompraController();


$compras =
    $controller->reporteCompras();

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=compras.xls"
);
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>ID</th>

    <th>Fecha</th>

    <th>Proveedor</th>

    <th>Factura</th>

    <th>Total</th>

</tr>

";
$totalCompras = 0;

foreach ($compras as $compra) {

    $totalCompras +=
        $compra['total'];

    echo "

    <tr>

        <td>{$compra['id']}</td>

        <td>{$compra['fecha']}</td>

        <td>{$compra['proveedor']}</td>

        <td>{$compra['factura']}</td>

        <td>{$compra['total']}</td>

    </tr>

    ";
}
echo "

<tr>

    <td colspan='4'>

        TOTAL COMPRAS

    </td>

    <td>

        {$totalCompras}

    </td>

</tr>

";

echo "</table>";
