<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new ReporteController();

$datos =
    $controller->gastosPorFecha($_GET['inicio'], $_GET['fin']);

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=gastos_fechas.xls"
);

header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>ID</th>

    <th>Fecha</th>

    <th>Categoria</th>

    <th>Descripcion</th>

    
    <th>Usuario</th>
    <th>Monto</th>

  
</tr>

";
$totalGeneral = 0;

foreach ($datos as $fila) {


    $totalGeneral +=
        $fila['monto'];


    echo "

    <tr>

        <td>{$fila['id']}</td>

        <td>{$fila['fecha']}</td>

        <td>{$fila['categoria']}</td>
        <td>{$fila['descripcion']}</td>
        <td>{$fila['usuario']}</td>
        <td>{$fila['monto']}</td>

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
