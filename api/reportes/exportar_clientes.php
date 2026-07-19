<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ClienteController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ClienteController();
$datos = $controller->listar();
$sheetColumn = 'H';
$excel = ExcelHelper::crearLibro("Clientes", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'ID',
        'Nombre',
        'Teléfono',
        'Correo',
        'Dirección',
        'Identificación',
        'Estado',
        'Fecha Registro',
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
foreach ($datos as $item) {
    $nombreCompleto = $item['nombres'] . " " . $item['apellidos'];
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $nombreCompleto);
    $sheet->setCellValue("C{$fila}", $item['telefono']);
    $sheet->setCellValue("D{$fila}", $item['correo']);
    $sheet->setCellValue("E{$fila}", $item['direccion']);
    $sheet->setCellValue("F{$fila}", $item['identificacion']);
    $sheet->setCellValue("G{$fila}", $item['estado']);
    $sheet->setCellValue("H{$fila}", $item['fecha_registro']);
    $fila++;
}
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Clientes");