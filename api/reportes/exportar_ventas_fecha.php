<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ReporteController();
$datos = $controller->ventasPorFecha($_GET['inicio'], $_GET['fin']);
$sheetColumn = 'F';
$excel = ExcelHelper::crearLibro("Ventas Por Fecha", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Factura',
        'Fecha',
        'Cliente',
        'Usuario',
        'Estado',
        'Total'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalVenta = 0;
$totalVentaAnulado = 0;
foreach ($datos as $item) {
    if ($item['estado'] !== 'ANULADA') {
        $totalVenta += $item['total'];
    } else {
        $totalVentaAnulado += $item['total'];
    }
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['cliente']);
    $sheet->setCellValue("D{$fila}", $item['usuario']);
    $sheet->setCellValue("E{$fila}", $item['estado']);
    $sheet->setCellValue("F{$fila}", $item['total']);
    ExcelHelper::estiloMoneda($sheet, "F{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "VENTAS ANULADAS");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalVentaAnulado);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL VENDIDO");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalVenta);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalVentaAnulado + $totalVenta);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
$fila++;
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Ventas_Por_Fecha");