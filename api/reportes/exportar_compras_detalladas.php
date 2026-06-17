<?php


require_once '../../app/controllers/CompraController.php';

$controller = new CompraController();

$datos = $controller->reporteComprasDetalladas();
header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=compras_detalladas.xls"
);

header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>Compra</th>

    <th>Fecha</th>

    <th>Proveedor</th>

    <th>Código</th>

    <th>Producto</th>

    <th>Cantidad</th>

    <th>Costo</th>

    <th>Subtotal</th>

</tr>

";
$totalGeneral = 0;

foreach ($datos as $fila) {

    $totalGeneral +=
        $fila['subtotal'];

    echo "

    <tr>

        <td>{$fila['compra']}</td>

        <td>{$fila['fecha']}</td>

        <td>{$fila['proveedor']}</td>

        <td>{$fila['codigo']}</td>

        <td>{$fila['producto']}</td>

        <td>{$fila['cantidad']}</td>

        <td>{$fila['costo']}</td>

        <td>{$fila['subtotal']}</td>

    </tr>

    ";
}
echo "

<tr>

    <td colspan='7'>

        TOTAL GENERAL

    </td>

    <td>

        {$totalGeneral}

    </td>

</tr>

";

echo "</table>";