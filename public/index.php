<?php

require_once '../app/helpers/Session.php';
require_once '../app/middleware/AuthMiddleware.php';
require_once '../app/helpers/permisos.php';

AuthMiddleware::verificar();
$modulo = $_GET['modulo'] ?? 'dashboard';
$inventarioActivo = in_array(
    $modulo,
    ['productos', 'marcas', 'categorias', 'kardex']
);
$reporteActivo = in_array(
    $modulo,
    ['reportes_compras', 'reportes_gastos', 'reportes_ventas', 'maestro_detalle', 'excel']
);
$configActivo = in_array(
    $modulo,
    [
        'usuarios',
        'roles',
        'permisos',
        'configuracion_empresa',
        'backup',
        'bitacora',
        'carta_recomendacion'
    ]
);

$mapaPermisos = [
    'dashboard' => 'dashboard_ver',
    'categorias' => 'categorias_ver',
    'marcas' => 'marcas_ver',
    'productos' => 'productos_ver',
    'clientes' => 'clientes_ver',
    'compras' => 'compras_crear',
    'proveedores' => 'proveedores_ver',
    'bitacora' => 'bitacora_ver',
    'usuarios' => 'usuarios_ver',
    'roles' => 'roles_ver',
    'backup' => 'backup_ver',
    'kardex' => 'kardex_ver',
    'configuracion_empresa' => 'empresa_configurar',
    'gastos' => 'gastos_ver',
    'maestro_detalle' => 'reportes_detalle_maestro',
    'excel' => 'excel_exportar',
    'ventas' => 'ventas_crear',
    'reportes_ventas' => 'reportes_ventas',
    'reportes_gastos' => 'reportes_gastos',
    'reportes_compras' => 'reportes_compras',
];

if (isset($mapaPermisos[$modulo])) {
    requierePermisoVista($mapaPermisos[$modulo]);
}

include '../view/layouts/header.php';
include '../view/layouts/navbar.php';
include '../view/layouts/sidebar.php';

switch ($modulo) {

    case 'usuarios':
        include '../view/configuracion/usuarios.php';
        break;
    case 'clientes':
        include '../view/clientes/index.php';
        break;
    case 'productos':
        include '../view/inventario/productos.php';
        break;
    case 'marcas':
        include '../view/inventario/marcas.php';
        break;
    case 'proveedores':
        include '../view/proveedores/index.php';
        break;
    case 'kardex':
        include '../view/kardex/index.php';
        break;
    case 'excel':
        include '../view/reportes/excel.php';
        break;
    case 'categorias':
        include '../view/inventario/categorias.php';
        break;
    case 'ventas':
        include '../view/ventas/index.php';
        break;
    case 'gastos':
        include '../view/gastos/index.php';
        break;
    case 'reportes_ventas':
        include  '../view/reportes/ventas.php';
        break;
    case 'reportes_gastos':
        include  '../view/reportes/gastos.php';
        break;
    case 'reportes_compras':
        include  '../view/reportes/compras.php';
        break;
    case 'roles':
        include  '../view/configuracion/roles.php';
        break;
    case 'compras':
        include  '../view/compras/index.php';
        break;
    case 'configuracion_empresa':
        include  '../view/configuracion/empresa.php';
        break;
    case 'backup':
        include  '../view/configuracion/backup.php';
        break;
    case 'bitacora':
        include '../view/bitacora/index.php';
        break;
    case 'maestro_detalle':
        include '../view/maestro_detalle/index.php';
        break;
    default:
        // include '../view/layouts/dashboard.php';
        include './dashboard.php';
        break;
}

include '../view/layouts/footer.php';
