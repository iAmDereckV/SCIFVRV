<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/VentaController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new VentaController();
$datos = $controller->reporteVentasDetalladas();
$sheetColumn = 'K';
$excel = ExcelHelper::crearLibro("Ventas Detalladas", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Factura',
        'Fecha',
        'Cliente',
        'Usuario',
        'Código Producto',
        'Producto',
        'Cantidad',
        'Costo Unitario',
        'Precio Unitario',
        'Subtotal',
        'Estado'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalCosto = 0;
$totalPrecio = 0;
$totalSubtotal = 0;
foreach ($datos as $item) {
    $totalCosto += $item['costo_unitario'];
    $totalPrecio += $item['precio_unitario'];
    $totalSubtotal += $item['subtotal'];
    $sheet->setCellValue("A{$fila}", $item['factura']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['cliente']);
    $sheet->setCellValue("D{$fila}", $item['usuario']);
    $sheet->setCellValue("E{$fila}", $item['codigo']);
    $sheet->setCellValue("F{$fila}", $item['producto']);
    $sheet->setCellValue("G{$fila}", $item['cantidad']);
    $sheet->setCellValue("H{$fila}", $item['costo_unitario']);
    $sheet->setCellValue("I{$fila}", $item['precio_unitario']);
    $sheet->setCellValue("J{$fila}", $item['subtotal']);
    $sheet->setCellValue("K{$fila}", $item['estado']);
    ExcelHelper::estiloMoneda($sheet, "H{$fila}:J{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:G{$fila}");
$sheet->setCellValue("H{$fila}", $totalCosto);
$sheet->setCellValue("I{$fila}", $totalPrecio);
$sheet->setCellValue("J{$fila}", $totalSubtotal);
ExcelHelper::estiloMoneda($sheet, "H{$fila}:J{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Ventas_Detalladas");