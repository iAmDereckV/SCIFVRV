<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/GastoController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new GastoController();
$datos = $controller->reporteGastos();
$sheetColumn = 'G';
$excel = ExcelHelper::crearLibro("Gastos", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'ID',
        'Fecha',
        'Categoría',
        'Descripción',
        'Usuario',
        'Nombre Factura',
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
    $sheet->setCellValue("F{$fila}", $item['archivo_factura']);
    $sheet->setCellValue("G{$fila}", $item['monto']);
    ExcelHelper::estiloMoneda($sheet, "G{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:F{$fila}");
$sheet->setCellValue("G{$fila}", $totalGeneral);
ExcelHelper::estiloMoneda($sheet, "G{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Gastos");