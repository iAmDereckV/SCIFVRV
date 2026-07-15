<?php
require_once '../../app/helpers/Permisos.php';

require_once '../../app/controllers/MaestroDetalleController.php';
requierePermiso(
    'excel_exportar'
);
$controller =
    new MaestroDetalleController();
$anio =
    $_GET['anio']
    ??
    date('Y');


$datos =
    $controller->obtenerResumen($anio);

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=maestro_detalle.xls"
);

header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "
<h2>

 Maestro Detalle Año {$anio}

</h2>
<table border='1'>

<tr>

    <th>Concepto</th>

    <th>Ene</th>
    <th>Feb</th>
    <th>Mar</th>
    <th>Abr</th>
    <th>May</th>
    <th>Jun</th>
    <th>Jul</th>
    <th>Ago</th>
    <th>Sep</th>
    <th>Oct</th>
    <th>Nov</th>
    <th>Dic</th>

    <th>Total</th>

</tr>

";
foreach ($datos as $fila) {

    echo "

    <tr>

        <td>{$fila['concepto']}</td>

        <td>{$fila['enero']}</td>
        <td>{$fila['febrero']}</td>
        <td>{$fila['marzo']}</td>
        <td>{$fila['abril']}</td>
        <td>{$fila['mayo']}</td>
        <td>{$fila['junio']}</td>
        <td>{$fila['julio']}</td>
        <td>{$fila['agosto']}</td>
        <td>{$fila['septiembre']}</td>
        <td>{$fila['octubre']}</td>
        <td>{$fila['noviembre']}</td>
        <td>{$fila['diciembre']}</td>

        <td>{$fila['total']}</td>

    </tr>

    ";
}
echo "</table>";
