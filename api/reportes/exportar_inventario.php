<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ProductoController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ProductoController();
$datos = $controller->listar();
$sheetColumn = 'K';
$excel = ExcelHelper::crearLibro("Inventario", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Código',
        'Producto',
        'Marca',
        'Categoría',
        'Precio Compra',
        'Precio Venta',
        'Stock',
        'Stock Mínimo',
        'Ubicacion',
        'Descripción',
        'estado'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
foreach ($datos as $item) {
    $sheet->setCellValue("A{$fila}", $item['codigo']);
    $sheet->setCellValue("B{$fila}", $item['nombre']);
    $sheet->setCellValue("C{$fila}", $item['marca']);
    $sheet->setCellValue("D{$fila}", $item['categoria']);
    $sheet->setCellValue("E{$fila}", $item['precio_compra']);
    $sheet->setCellValue("F{$fila}", $item['precio_venta']);
    $sheet->setCellValue("G{$fila}", $item['stock']);
    $sheet->setCellValue("H{$fila}", $item['stock_minimo']);
    $sheet->setCellValue("I{$fila}", $item['ubicacion']);
    $sheet->setCellValue("J{$fila}", $item['descripcion']);
    $sheet->setCellValue("K{$fila}", $item['estado']);
    $fila++;
}
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Inventario");