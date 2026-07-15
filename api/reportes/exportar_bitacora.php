<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/BitacoraController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new Bitacora();

$datos =
    $controller->listar();

header(
    "Content-Type: application/vnd.ms-excel"
);

header(
    "Content-Disposition: attachment; filename=bitacora.xls"
);

header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    

    <th>Fecha</th>

    <th>Tipo</th>

    <th>Referencia</th>

    <th>Descripción</th>

    <th>Entrada</th>

    <th>Salida</th>

    <th>Usuario</th>


</tr>

";
$totalGeneral = 0;

foreach ($datos as $fila) {



    echo "

    <tr>

        <td>{$fila['fecha']}</td>

        <td>{$fila['tipo']}</td>

        <td>{$fila['referencia']}</td>

        <td>{$fila['descripcion']}</td>

        <td>{$fila['entrada']}</td>

        <td>{$fila['salida']}</td>

        <td>{$fila['usuario']}</td>



    </tr>

    ";
}

echo "</table>";
