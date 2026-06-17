<?php

require_once '../../app/libraries/fpdf/fpdf.php';

require_once '../../app/controllers/VentaController.php';
require_once '../../app/controllers/ConfiguracionEmpresaController.php';

$venta_id =
    $_GET['id'];

$controllerVenta =
    new VentaController();

$controllerEmpresa =
    new ConfiguracionEmpresaController();

$venta =
    $controllerVenta->obtenerFactura(
        $venta_id
    );

$detalle =
    $controllerVenta->obtenerDetalleFactura(
        $venta_id
    );

$empresa =
    $controllerEmpresa->obtener();

$pdf =
    new FPDF();

$pdf->AddPage();
if ($venta['estado'] === 'ANULADA') {

    $x = $pdf->GetX();
    $y = $pdf->GetY();

    $pdf->SetFont('Arial', 'B', 50);
    $pdf->SetTextColor(230, 230, 230);

    $pdf->SetXY(20, 120);

    $pdf->Cell(
        0,
        15,
        'ANULADA',
        0,
        0,
        'C'
    );

    $pdf->SetTextColor(0, 0, 0);

    $pdf->SetXY($x, $y);
}
$pdf->SetFont(
    'Arial',
    'B',
    25
);
if (
    !empty($empresa['logo'])
) {

    $pdf->Image(

        '../../public/uploads/empresa/'
            .
            $empresa['logo'],

        10,

        10,

        25

    );
}
$pdf->Cell(
    0,
    15,

    utf8_decode(
        $empresa['nombre_empresa']
    ),

    0,
    1,
    'C'
);
$pdf->Ln(15);

$pdf->SetFont(
    'Arial',
    'I',
    10
);
if (!empty($empresa['ruc'])) {
    $pdf->Cell(
        0,
        6,
        utf8_decode(
            'RUC: '
                .
                $empresa['ruc']
        ),

        0,
        1
    );
}

$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Teléfono: '
            .
            $empresa['telefono']
    ),

    0,
    1
);

if (!empty($empresa['correo'])) {
    $pdf->Cell(
        0,
        6,
        utf8_decode(
            'Correo: '
                .
                $empresa['correo']
        ),

        0,
        1
    );
}

$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Dirección: '
            .
            $empresa['direccion']
    ),

    0,
    1
);

$pdf->SetFillColor(230, 230, 230);
$pdf->Ln(5);

$pdf->SetFont(
    'Arial',
    'B',
    12
);
$pdf->Cell(
    190,
    8,
    'DATOS DE FACTURA',
    1,
    1,
    'C',
    true
);

$pdf->Ln(5);
$pdf->SetFont(
    'Arial',
    'I',
    10
);
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Factura #: ' . $venta['id'],
    ),

    0,
    1
);
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Fecha: ' . $venta['fecha'],
    ),

    0,
    1
);

$pdf->Ln();
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Cliente: ' . $venta['cliente'],
    ),

    0,
    1
);
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Teléfono: ' . $venta['telefono'],
    ),

    0,
    1
);
$pdf->Ln();
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Vendedor: ' . $venta['usuario'],
    ),

    0,
    1
);
$pdf->Cell(
    0,
    6,
    utf8_decode(
        'Correo: ' . $venta['correo'],
    ),

    0,
    1
);
$pdf->Ln(5);





$pdf->SetFillColor(
    220,
    220,
    220
);

$pdf->SetFont(
    'Arial',
    'B',
    10
);

$pdf->Cell(25, 8, 'Codigo', 1, 0, 'C', true);
$pdf->Cell(70, 8, 'Producto', 1, 0, 'C', true);
$pdf->Cell(20, 8, 'Cant.', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Precio', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'Subtotal', 1, 1, 'C', true);
$pdf->SetFont(
    'Arial',
    'I',
    10
);
foreach (
    $detalle
    as
    $item
) {

    $pdf->Cell(
        25,
        8,

        $item['codigo'],

        1
    );

    $pdf->Cell(
        70,
        8,

        utf8_decode(
            $item['producto']
        ),

        1
    );

    $pdf->Cell(
        20,
        8,

        $item['cantidad'],

        1
    );

    $pdf->Cell(
        35,
        8,

        number_format(
            $item['precio_unitario'],
            2
        ),

        1
    );

    $pdf->Cell(
        40,
        8,

        number_format(
            $item['subtotal'],
            2
        ),

        1
    );
    $pdf->Ln();
}
$pdf->Ln(5);

$pdf->Cell(120, 8, '', 0);

$pdf->Cell(35, 8, 'Subtotal:', 1);

$pdf->Cell(
    35,
    8,
    'C$ ' . number_format($venta['subtotal'], 2),
    1,
    1
);

$pdf->Cell(120, 8, '', 0);
$pdf->SetFont(
    'Arial',
    'B',
    11
);
$pdf->Cell(35, 8, 'Impuesto:', 1);

$pdf->Cell(
    35,
    8,
    'C$ ' . number_format($venta['impuesto'], 2),
    1,
    1
);

$pdf->Cell(120, 8, '', 0);

$pdf->Cell(35, 8, 'Descuento:', 1);

$pdf->Cell(
    35,
    8,
    'C$ ' . number_format($venta['descuento'], 2),
    1,
    1
);

$pdf->Cell(120, 8, '', 0);

$pdf->Cell(35, 8, 'TOTAL:', 1);

$pdf->Cell(
    35,
    8,
    'C$ ' . number_format($venta['total'], 2),
    1,
    1
);
$pdf->Ln(15);

$pdf->SetFont(
    'Arial',
    'I',
    9
);

$pdf->Cell(
    0,
    5,
    utf8_decode(
        $empresa['slogan']
    ),
    0,
    1,
    'C'
);

$pdf->Cell(
    0,
    5,
    utf8_decode(
        'Gracias por su compra'
    ),
    0,
    1,
    'C'
);

$pdf->Output();