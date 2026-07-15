<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ClienteController.php';
requierePermiso(
    'excel_exportar'
);
$controller = new ClienteController();

$clientes = $controller->listar();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=clientes.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "

<table border='1'>

<tr>

    <th>ID</th>

    <th>Nombre</th>

    <th>Teléfono</th>

    <th>Correo</th>

    <th>Dirección</th>

    <th>Identificación</th>

    <th>Fecha Registro</th>


</tr>

";
foreach ($clientes as $cliente) {

    echo "

    <tr>

        <td>{$cliente['id']}</td>

        <td>{$cliente['nombres']} {$cliente['apellidos']}</td>

        <td>{$cliente['telefono']}</td>

        <td>{$cliente['correo']}</td>

        <td>{$cliente['direccion']}</td>

        <td>{$cliente['identificacion']}</td>

        <td>{$cliente['fecha_registro']}</td>


    </tr>

    ";
}

echo "</table>";
