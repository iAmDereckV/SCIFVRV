<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/VentaController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new VentaController();
$datos = $controller->reporteVentas();
$sheetColumn = 'I';
$excel = ExcelHelper::crearLibro("Ventas", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Factura',
        'Fecha',
        'Cliente',
        'Usuario',
        'Subtotal',
        'Descuento',
        'Impuesto',
        'Total',
        'Estado'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalSubtotal = 0;
$totalDescuento = 0;
$totalImpuesto = 0;
$totalVentas = 0;
$totalSubtotalAnuladas = 0;
$totalDescuentoAnuladas = 0;
$totalImpuestoAnuladas = 0;
$totalVentasAnuladas = 0;
foreach ($datos as $item) {
    if ($item['estado'] === 'COMPLETADA') {
        $totalSubtotal += $item['subtotal'];
        $totalDescuento += $item['descuento'];
        $totalImpuesto += $item['impuesto'];
        $totalVentas += $item['total'];
    } else {
        $totalSubtotalAnuladas += $item['subtotal'];
        $totalDescuentoAnuladas += $item['descuento'];
        $totalImpuestoAnuladas += $item['impuesto'];
        $totalVentasAnuladas += $item['total'];
    }
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['cliente']);
    $sheet->setCellValue("D{$fila}", $item['usuario']);
    $sheet->setCellValue("E{$fila}", $item['subtotal']);
    $sheet->setCellValue("F{$fila}", $item['descuento']);
    $sheet->setCellValue("G{$fila}", $item['impuesto']);
    $sheet->setCellValue("H{$fila}", $item['total']);
    $sheet->setCellValue("I{$fila}", $item['estado']);
    ExcelHelper::estiloMoneda($sheet, "E{$fila}:H{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "VENTAS ANULADA");
$sheet->mergeCells("A{$fila}:D{$fila}");
$sheet->setCellValue("E{$fila}", $totalSubtotalAnuladas);
$sheet->setCellValue("F{$fila}", $totalDescuentoAnuladas);
$sheet->setCellValue("G{$fila}", $totalImpuestoAnuladas);
$sheet->setCellValue("H{$fila}", $totalVentasAnuladas);
ExcelHelper::estiloMoneda($sheet, "E{$fila}:H{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL VENDIDO");
$sheet->mergeCells("A{$fila}:D{$fila}");
$sheet->setCellValue("E{$fila}", $totalSubtotal);
$sheet->setCellValue("F{$fila}", $totalDescuento);
$sheet->setCellValue("G{$fila}", $totalImpuesto);
$sheet->setCellValue("H{$fila}", $totalVentas);
ExcelHelper::estiloMoneda($sheet, "E{$fila}:H{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:D{$fila}");
$sheet->setCellValue("E{$fila}", $totalSubtotalAnuladas + $totalSubtotal);
$sheet->setCellValue("F{$fila}", $totalDescuentoAnuladas + $totalDescuento);
$sheet->setCellValue("G{$fila}", $totalImpuestoAnuladas + $totalImpuesto);
$sheet->setCellValue("H{$fila}", $totalVentasAnuladas + $totalVentas);
ExcelHelper::estiloMoneda($sheet, "E{$fila}:H{$fila}");
$fila++;
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Compras");