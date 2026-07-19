<?php
require_once '../../app/helpers/Permisos.php';
require_once '../../app/controllers/ProveedorController.php';
require '../../vendor/autoload.php';
require_once '../../app/helpers/ExcelHelper.php';
requierePermiso('excel_exportar');
$controller = new ProveedorController();
$datos = $controller->listar();
$sheetColumn = 'G';
$excel = ExcelHelper::crearLibro("Proveedores", $sheetColumn);
$sheet = $excel->getActiveSheet();
$fila = ExcelHelper::filaInicioTabla();
$sheet->fromArray([
    [
        'ID',
        'Nombre Empresa',
        'Nombre Contacto',
        'Teléfono',
        'Correo',
        'Dirreción',
        'Estado'
    ]
], null, 'A' . $fila);
ExcelHelper::estiloCabecera($sheet, "A{$fila}:{$sheetColumn}{$fila}");
$fila++;
foreach ($datos as $item) {
    $sheet->setCellValue("A{$fila}", $item['id']);
    $sheet->setCellValue("B{$fila}", $item['nombre']);
    $sheet->setCellValue("C{$fila}", $item['contacto']);
    $sheet->setCellValue("D{$fila}", $item['telefono']);
    $sheet->setCellValue("E{$fila}", $item['correo']);
    $sheet->setCellValue("F{$fila}", $item['direccion']);
    $sheet->setCellValue("G{$fila}", $item['estado']);
    $fila++;
}
foreach (range('A', $sheetColumn) as $col) {
    $sheet
        ->getColumnDimension($col)
        ->setAutoSize(true);
}
ExcelHelper::descargar($excel, "Proveedores");