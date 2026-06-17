<?php

$permisos = [

    'Administrador' => [
        '*'
    ],

    'Supervisor' => [
        'dashboard',
        'productos',
        'inventario',
        'clientes',
        'ventas',
        'reportes',
        'gastos',
        'cartas'
    ],

    'Vendedor' => [
        'dashboard',
        'clientes',
        'ventas',
        'cartas'
    ],

    'Consulta' => [
        'dashboard',
        'clientes',
        'productos',
        'inventario',
        'reportes'
    ]
];
function tienePermiso($rol, $modulo)
{
    global $permisos;

    if (!isset($permisos[$rol])) {
        return false;
    }

    if (in_array('*', $permisos[$rol])) {
        return true;
    }

    return in_array($modulo, $permisos[$rol]);
}
