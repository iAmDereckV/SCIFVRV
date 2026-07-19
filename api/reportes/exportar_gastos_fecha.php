<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ReporteController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ReporteController();
$datos = $controller->gastosPorFecha($_GET['inicio'], $_GET['fin']);
$sheetColumn = 'F';
$excel = ExcelHelper::crearLibro("Gasto Por Fecha", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'ID',
        'Fecha',
        'Categoría',
        'Descripción',
        'Usuario',
        'Monto'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalGeneral = 0;
foreach ($datos as $item) {
    $totalGeneral += $item['monto'];
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['categoria']);
    $sheet->setCellValue("D{$fila}", $item['descripcion']);
    $sheet->setCellValue("E{$fila}", $item['usuario']);
    $sheet->setCellValue("F{$fila}", $item['monto']);
    ExcelHelper::estiloMoneda($sheet, "B{$fila}:N{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:E{$fila}");
$sheet->setCellValue("F{$fila}", $totalGeneral);
ExcelHelper::estiloMoneda($sheet, "F{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Gastos_Por_Fecha");