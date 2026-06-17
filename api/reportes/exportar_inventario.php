<?php

require_once '../../app/controllers/ProductoController.php';

$controller = new ProductoController();

$productos = $controller->listar();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=inventario.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "\xEF\xBB\xBF";
echo "
<table border='1'>

<tr>

    <th>Código</th>

    <th>Producto</th>

    <th>Marca</th>

    <th>Categoría</th>

    <th>Precio Compra</th>

    <th>Precio Venta</th>

    <th>Stock</th>

    <th>Stock Mínimo</th>

</tr>
";

foreach ($productos as $producto) {

    echo "

    <tr>

        <td>{$producto['codigo']}</td>

        <td>{$producto['nombre']}</td>

        <td>{$producto['marca']}</td>

        <td>{$producto['categoria']}</td>

        <td>{$producto['precio_compra']}</td>

        <td>{$producto['precio_venta']}</td>

        <td>{$producto['stock']}</td>

        <td>{$producto['stock_minimo']}</td>

    </tr>

    ";
}

echo "</table>";