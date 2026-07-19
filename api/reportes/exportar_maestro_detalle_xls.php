<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/MaestroDetalleController.php';
requierePermiso('excel_exportar');
$controller = new MaestroDetalleController();
$anio = $_GET['anio'] ?? date('Y');
$datos = $controller->obtenerResumen($anio);
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=maestro_detalle.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
// ? STYLE
echo "
<style>
table{
    border-collapse:collapse;
    width:100%;
    font-family:Calibri,Arial;
    font-size:11pt;
}

th{
    background:#1e3a5f;
    color:white;
    font-weight:bold;
    text-align:center;
    border:1px solid #000;
    padding:6px;
}

td{
    border:1px solid #000;
    padding:5px;
}

.titulo{
    font-size:18pt;
    font-weight:bold;
    color:#1e3a5f;
}
        
.subtitulo{
    font-size:11pt;
    color:#555;
}
.total{
    background:#d9ead3;
    font-weight:bold;
}
</style>";
// ? BANNER
echo "
<table>
<tr>
<td colspan='14' class='titulo' align='center'>
MAESTRO DETALLE AÑO {$anio}
</td>
</tr>
<tr>
<td colspan='14' class='subtitulo' align='center'>
Fecha de impresión: " . date('d/m/Y H:i:s') . "
</td>
</tr>
</table>
<br>";
// ? THEAD
echo "
<table>
<tr>
<th>Concepto</th>
<th>Enero</th>
<th>Febrero</th>
<th>Marzo</th>
<th>Abril</th>
<th>Mayo</th>
<th>Junio</th>
<th>Julio</th>
<th>Agosto</th>
<th>Septiembre</th>
<th>Octubre</th>
<th>Noviembre</th>
<th>Diciembre</th>
<th>Total</th>
</tr>
";
// ? TBODY
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
// ? TRTOTAL
echo "</table>";