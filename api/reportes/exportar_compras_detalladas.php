<?php

require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/CompraController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new CompraController();
$datos = $controller->reporteComprasDetalladas();
$sheetColumn = 'K';
$excel = ExcelHelper::crearLibro("Compras Detalladas", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'Compra',
        'Fecha',
        'Estado',
        'Proveedor',
        'Usuario',
        'Código',
        'Producto',
        'Cantidad',
        'Costo',
        'Subtotal',
        'Estado'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
$totalCantidad = 0;
$totalCosto = 0;
$totalCompletada = 0;
$totalGeneral = 0;
foreach ($datos as $item) {
    $totalCantidad += $item['cantidad'];
    $totalCosto += $item['costo'];
    $totalGeneral += $item['subtotal'];
    $sheet->setCellValue("A{$fila}", $item['compra']);
    $sheet->setCellValue("B{$fila}", $item['fecha']);
    $sheet->setCellValue("C{$fila}", $item['estado']);
    $sheet->setCellValue("D{$fila}", $item['proveedor']);
    $sheet->setCellValue("E{$fila}", $item['usuario']);
    $sheet->setCellValue("F{$fila}", $item['codigo']);
    $sheet->setCellValue("G{$fila}", $item['producto']);
    $sheet->setCellValue("H{$fila}", $item['cantidad']);
    $sheet->setCellValue("I{$fila}", $item['costo']);
    $sheet->setCellValue("J{$fila}", $item['subtotal']);
    $sheet->setCellValue("K{$fila}", $item['estado']);
    ExcelHelper::estiloMoneda($sheet, "I{$fila}:J{$fila}");
    $fila++;
}
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$sheet->setCellValue("A{$fila}", "TOTAL GENERAL");
$sheet->mergeCells("A{$fila}:G{$fila}");
$sheet->setCellValue("H{$fila}", $totalCantidad);
$sheet->setCellValue("I{$fila}", $totalCosto);
$sheet->setCellValue("J{$fila}", $totalGeneral);
ExcelHelper::estiloMoneda($sheet, "I{$fila}:J{$fila}");
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Compras_Detalladas");