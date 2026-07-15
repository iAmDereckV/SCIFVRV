<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new ReporteController();

$datos =
    $controller->ventasPorFecha($_GET['inicio'], $_GET['fin']);

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=ventas_fechas.xls"
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

    <th>Vendedor</th>

    
    <th>Estado</th>
    <th>Total</th>

  
</tr>

";
$totalGeneral = 0;

foreach ($datos as $fila) {

    if (
        $fila['estado']
        !== 'ANULADA'
    ) {
        $totalGeneral +=
            $fila['total'];
    }

    echo "

    <tr>

        <td>{$fila['id']}</td>

        <td>{$fila['fecha']}</td>

        <td>{$fila['cliente']}</td>

        <td>{$fila['usuario']}</td>

        
        <td>{$fila['estado']}</td>
        <td>{$fila['total']}</td>

    </tr>

    ";
}
echo "

<tr>

    <td colspan='5'>

        TOTAL GENERAL

    </td>

    
    <td>

        {$totalGeneral}

    </td>
    


</tr>

";
echo "</table>";
