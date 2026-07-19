<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/CompraController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new CompraController();
$datos = $controller->reporteCompras();
$sheetColumn = 'G';
$excel = ExcelHelper::crearLibro("Compras", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'ID',
        'Proveedor',
        'Usuario',
        'Fecha',
        'Nombre Factura',
        'Estado',
        'Total'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalCompras = 0;
$totalComprasAnuladas = 0;
foreach ($datos as $item) {
    if ($item['estado'] === 'COMPLETADA') {
        $totalCompras += $item['total'];
    } else {
        $totalComprasAnuladas += $item['total'];
    }
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['proveedor']);
    $sheet->setCellValue("C{$fila}", $item['usuario']);
    $sheet->setCellValue("D{$fila}", $item['fecha']);
    $sheet->setCellValue("E{$fila}", $item['factura_proveedor']);
    $sheet->setCellValue("F{$fila}", $item['estado']);
    $sheet->setCellValue("G{$fila}", $item['total']);
    ExcelHelper::estiloMoneda($sheet, "G{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "COMPRAS ANULADA");
$sheet->mergeCells("A{$fila}:F{$fila}");
$sheet->setCellValue("G{$fila}", $totalComprasAnuladas);
ExcelHelper::estiloMoneda($sheet, "G{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL COMPRADO");
$sheet->mergeCells("A{$fila}:F{$fila}");
$sheet->setCellValue("G{$fila}", $totalCompras);
ExcelHelper::estiloMoneda($sheet, "G{$fila}");
$fila++;
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:F{$fila}");
$sheet->setCellValue("G{$fila}", $totalCompras + $totalComprasAnuladas);
ExcelHelper::estiloMoneda($sheet, "G{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Compras");