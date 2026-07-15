<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/GastoController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new GastoController();

$gastos = $controller->reporteGastos();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=gastos.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>ID</th>

    <th>Fecha</th>

    <th>Categoría</th>

    <th>Descripción</th>

    <th>Monto</th>

    <th>Usuario</th>

</tr>

";
foreach ($gastos as $gasto) {

    echo "

    <tr>

        <td>{$gasto['id']}</td>

        <td>{$gasto['fecha']}</td>

        <td>{$gasto['categoria']}</td>

        <td>{$gasto['descripcion']}</td>

        <td>{$gasto['monto']}</td>

        <td>{$gasto['usuario']}</td>

    </tr>

    ";
}
$total = 0;

foreach ($gastos as $gasto) {

    $total += $gasto['monto'];
}
echo "
    
    <tr>
    
        <td colspan='4'>
    
            TOTAL GASTOS
    
        </td>
    
        <td>
    
            {$total}
    
        </td>
    
        <td></td>
    
    </tr>
    
    ";

echo "</table>";
