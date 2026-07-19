<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ReporteController();
$datos = $controller->comprasPorFecha($_GET['inicio'], $_GET['fin']);
$sheetColumn = 'F';
$excel = ExcelHelper::crearLibro("Compras Por Fecha", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Compra',
        'Fecha',
        'Proveedor',
        'Usuario',
        'Estado',
        'Total'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalCompra = 0;
$totalCompraAnulado = 0;
foreach ($datos as $item) {
    if ($item['estado'] !== 'ANULADA') {
        $totalCompra += $item['total'];
    } else {
        $totalCompraAnulado += $item['total'];
    }
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['proveedor']);
    $sheet->setCellValue("D{$fila}", $item['usuario']);
    $sheet->setCellValue("E{$fila}", $item['estado']);
    $sheet->setCellValue("F{$fila}", $item['total']);
    ExcelHelper::estiloMoneda($sheet, "F{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "COMPRAS ANULADAS");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalCompraAnulado);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "COMPRADO");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalCompra);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalCompraAnulado + $totalCompra);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Compras_Por_Fecha");