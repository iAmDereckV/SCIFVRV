<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/MaestroDetalleController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new MaestroDetalleController();
$anio = $_GET['anio'] ?? date('Y');
$datos = $controller->obtenerResumen($anio);
$sheetColumn = 'N';
// |--------------------------------------------------------------------------
// | //? Crear libro
// |--------------------------------------------------------------------------
$excel = ExcelHelper::crearLibro("Maestro Detalle Año {$anio}", $sheetColumn);
$sheet = $excel->getActiveSheet();

// |--------------------------------------------------------------------------
// | //? Encabezado de tabla
// |--------------------------------------------------------------------------
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Concepto',
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
        'Total'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;

// |--------------------------------------------------------------------------
// | //? Datos
// |--------------------------------------------------------------------------
foreach ($datos as $item) {
    $sheet->setCellValue("A{$fila}", $item['concepto']);
    $sheet->setCellValue("B{$fila}", $item['enero']);
    $sheet->setCellValue("C{$fila}", $item['febrero']);
    $sheet->setCellValue("D{$fila}", $item['marzo']);
    $sheet->setCellValue("E{$fila}", $item['abril']);
    $sheet->setCellValue("F{$fila}", $item['mayo']);
    $sheet->setCellValue("G{$fila}", $item['junio']);
    $sheet->setCellValue("H{$fila}", $item['julio']);
    $sheet->setCellValue("I{$fila}", $item['agosto']);
    $sheet->setCellValue("J{$fila}", $item['septiembre']);
    $sheet->setCellValue("K{$fila}", $item['octubre']);
    $sheet->setCellValue("L{$fila}", $item['noviembre']);
    $sheet->setCellValue("M{$fila}", $item['diciembre']);
    $sheet->setCellValue("N{$fila}", $item['total']);
    ExcelHelper::estiloMoneda($sheet, "B{$fila}:N{$fila}");
    $fila++;
}
// |--------------------------------------------------------------------------
// | //? Datos total
// |--------------------------------------------------------------------------
// ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
// $sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
// $sheet->mergeCells("A{$fila}:G{$fila}");
// $sheet->setCellValue("H{$fila}", $totalGeneral);
// ExcelHelper::estiloMoneda($sheet, "H{$fila}:H{$fila}");

// |--------------------------------------------------------------------------
// | //? Ajustar ancho automático
// |--------------------------------------------------------------------------
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
// |--------------------------------------------------------------------------
// | //? Descargar
// |--------------------------------------------------------------------------
ExcelHelper::descargar($excel, "Maestro_Detalle_{$anio}");