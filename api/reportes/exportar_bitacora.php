<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/BitacoraController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new Bitacora();
$sheetColumn = 'G';
$datos = $controller->listar();
$excel = ExcelHelper::crearLibro("Bitacora General", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Fecha',
        'Tipo',
        'Referencia',
        'Descripción',
        'Entrada',
        'Salida',
        'Usuario'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$TEntreda = 0;
$TSalida = 0;
foreach ($datos as $item) {
    $TEntreda += $item['entrada'];
    $TSalida += $item['salida'];
    $sheet->setCellValue("A{$fila}", $item['fecha']);
    $sheet->setCellValue("B{$fila}", $item['tipo']);
    $sheet->setCellValue("C{$fila}", $item['referencia']);
    $sheet->setCellValue("D{$fila}", $item['descripcion']);
    $sheet->setCellValue("E{$fila}", $item['entrada']);
    $sheet->setCellValue("F{$fila}", $item['salida']);
    $sheet->setCellValue("G{$fila}", $item['usuario']);
    ExcelHelper::estiloMoneda($sheet, "E{$fila}:F{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:D{$fila}");
$sheet->setCellValue("E{$fila}", $TEntreda);
$sheet->setCellValue("F{$fila}", $TSalida);
ExcelHelper::estiloMoneda($sheet, "E{$fila}:F{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Bitacora");