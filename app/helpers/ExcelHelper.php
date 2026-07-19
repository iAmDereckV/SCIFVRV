<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/../controllers/ConfiguracionEmpresaController.php';

class ExcelHelper
{
    /** Crear libro con encabezado corporativo */
    public static function crearLibro(string $titulo, string $ultimaColumna = 'N', string $nombreHoja = 'Hoja 1')
    {
        $excel = new Spreadsheet();
        $empresa = self::obtenerEmpresa();
        $hoja = $excel->getActiveSheet();
        $hoja->setTitle($nombreHoja);
        self::buscarLogo($hoja);
        // Nombre empresa
        $hoja->mergeCells("B1:{$ultimaColumna}1");
        $hoja->setCellValue('B1', $empresa['nombre_empresa']);
        self::estiloTitulo($hoja, "B1:{$ultimaColumna}1", 22);
        // Título
        $hoja->mergeCells("B2:{$ultimaColumna}2");
        $hoja->setCellValue('B2', $titulo);
        self::estiloTitulo($hoja, "B2:{$ultimaColumna}2", 16);
        // Slogan
        $hoja->mergeCells("C3:{$ultimaColumna}3");
        $hoja->setCellValue('C3', $empresa['slogan']);
        $hoja->getStyle("C3:{$ultimaColumna}3")->getFont()->setItalic(true);
        // Fecha
        $fecha = new DateTime('now', new DateTimeZone('America/Managua'));
        $hoja->mergeCells('A5:D5');
        $hoja->setCellValue('A5', 'Fecha de impresión: ' . $fecha->format('d/m/Y h:i A'));
        $hoja->getStyle('A5:D5')->getFont()->setItalic(true)->setSize(12);
        $hoja->getStyle('A5:D5')->getAlignment()->setHorizontal(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
        );
        $hoja->getStyle('A5:D5')->getAlignment()->setVertical(
            \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        );
        $hoja->getStyle('A5:D5')->applyFromArray([
            'font' => ['italic' => true, 'size' => 10],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F2F2F2']
            ]
        ]);
        return $excel;
    }
    /** Obtener datos */
    private static function obtenerEmpresa()
    {
        $controller = new ConfiguracionEmpresaController();
        return $controller->obtener();
    }
    /** Buscar automáticamente logo_empresa */
    public static function buscarLogo($hoja)
    {
        $carpeta = __DIR__ . '/../../public/uploads/empresa/';
        $extensiones = ['png', 'jpg', 'jpeg', 'webp'];
        foreach ($extensiones as $ext) {
            $archivo = $carpeta . 'logo_empresa.' . $ext;
            if (file_exists($archivo)) {
                $logo = new Drawing();
                $logo->setName('Logo');
                $logo->setPath($archivo);
                $logo->setCoordinates('A1');
                $logo->setHeight(105);
                $logo->setWorksheet($hoja);
                return;
            }
        }
    }

    /** Fila donde inicia la tabla */
    public static function filaInicioTabla()
    {
        return 7;
    }

    /** Cabecera de tabla */
    public static function estiloCabecera($hoja, string $rango)
    {
        $hoja->getStyle($rango)
            ->getFont()
            ->setBold(true);

        $hoja->getStyle($rango)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $hoja->getStyle($rango)
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB('D9EAF7');
    }

    /** Monedas */
    public static function estiloMoneda($hoja, string $rango)
    {
        $hoja->getStyle($rango)
            ->getNumberFormat()
            ->setFormatCode('"C$"#,##0.00');
    }

    /** Título principal */
    public static function estiloTitulo($hoja, string $rango, int $size)
    {
        $hoja->getStyle($rango)
            ->getFont()
            ->setBold(true)
            ->setSize($size);

        $hoja->getStyle($rango)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    /** Descargar */
    public static function descargar($excel, string $nombreArchivo)
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($excel);
        $writer->save('php://output');
        exit;
    }
}