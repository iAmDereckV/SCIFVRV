<?php

require_once __DIR__ . '/../../app/helpers/Session.php';
require_once __DIR__ . '/../../app/helpers/permisos.php';

Session::iniciar();


?>

<div class="container-fluid">

    <div class="row">

        <div class="d-flex flex-column flex-shrink-0 p-3 text-white col-md-2 min-vh-100 sidebar"><img src=""
                id="navlogo" class="rounded-circle mx-auto d-block shadow" width="85" height="85"
                style="object-fit:cover;background:white;padding:5px;">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <?php if (tienePermiso('dashboard_ver')): ?>
                <li class="nav-item ">
                    <a href="index.php" class="nav-link text-white <?= $modulo == 'dashboard' ? 'active' : '' ?>"
                        aria-current="page">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <?php endif; ?>
                <?php if (tienePermiso('productos_ver') || tienePermiso('marcas_ver') || tienePermiso('categorias_ver') || tienePermiso('kardex_ver')): ?>
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $inventarioActivo ? 'active' : '' ?>"
                        id="dropdownInventario" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-boxes"></i> Inventario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownInventario">
                        <?php if (tienePermiso('productos_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=productos"><i class="bi bi-box-seam"></i>
                                Productos</a></li> <?php endif; ?>
                        <?php if (tienePermiso('marcas_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=marcas"><i class="bi bi-bookmark-star"></i>
                                Marcas</a></li> <?php endif; ?>
                        <?php if (tienePermiso('categorias_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=categorias"><i class="bi bi-tags"></i>
                                Categorías</a></li> <?php endif; ?>
                        <?php if (tienePermiso('kardex_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=kardex"><i class="bi bi-journal-text"></i>
                                Kardex</a></li> <?php endif; ?>
                    </ul>
                </li> <?php endif; ?>
                <?php if (tienePermiso('clientes_ver')): ?>
                <li class="nav-item">
                    <a href="index.php?modulo=clientes"
                        class="nav-link  text-white <?= $modulo == 'clientes' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                </li>
                <?php endif; ?>
                <?php if (tienePermiso('proveedores_ver')): ?>
                <li class="nav-item">
                    <a href="index.php?modulo=proveedores"
                        class="nav-link  text-white <?= $modulo == 'proveedores' ? 'active' : '' ?>"
                        aria-current="page">
                        <i class="bi bi-box2-heart"></i> Proveedor
                    </a>
                </li>
                <?php endif; ?>
                <?php if (tienePermiso('ventas_crear')): ?>
                <li class="nav-item">
                    <a href="index.php?modulo=ventas"
                        class="nav-link  text-white <?= $modulo == 'ventas' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-cart-check"></i> Ventas
                    </a>
                </li>
                <?php endif; ?>
                <?php if (tienePermiso('gastos_ver')): ?>
                <li class="nav-item">
                    <a href="index.php?modulo=gastos"
                        class="nav-link  text-white <?= $modulo == 'gastos' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-cash-stack"></i> Gastos
                    </a>
                </li>
                <?php endif; ?>
                <?php if (tienePermiso('compras_crear')): ?>
                <li class="nav-item">
                    <a href="index.php?modulo=compras"
                        class="nav-link  text-white <?= $modulo == 'compras' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-bag-plus"></i> Compras
                    </a>
                </li>
                <?php endif; ?>
                <?php if (

                    tienePermiso('reportes_ventas')
                    ||
                    tienePermiso('reportes_gastos')
                    ||
                    tienePermiso('reportes_compras')
                    ||
                    tienePermiso('reportes_detalle_maestro')
                    ||
                    tienePermiso('excel_exportar')

                ): ?>
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $reporteActivo ? 'active' : '' ?>"
                        id="dropdownReportes" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bar-chart-line"></i> Reportes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownReportes">
                        <?php if (tienePermiso('reportes_ventas')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_ventas"><i
                                    class="bi bi-cart-check"></i>
                                Ventas</a></li> <?php endif; ?>
                        <?php if (tienePermiso('reportes_gastos')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_gastos"><i
                                    class="bi bi-cash-stack"></i>
                                Gastos</a></li><?php endif; ?>
                        <?php if (tienePermiso('reportes_compras')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_compras"><i
                                    class="bi bi-bag-plus"></i>
                                Compras</a></li><?php endif; ?>
                        <?php if (tienePermiso('reportes_detalle_maestro')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=maestro_detalle"><i
                                    class="bi bi-card-list"></i>
                                Detalle Maestro</a></li><?php endif; ?>
                        <?php if (tienePermiso('excel_exportar')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=excel"><i class="bi bi-download"></i>
                                Excel</a></li><?php endif; ?>

                    </ul>
                </li>

                <?php endif; ?>
            </ul>
            <hr>
            <?php if (

                tienePermiso('usuarios_ver')
                ||
                tienePermiso('roles_ver')
                ||
                tienePermiso('empresa_configurar')
                ||
                tienePermiso('backup_ver')

            ): ?>
            <ul class="nav nav-pills flex-column">
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $configActivo ? 'active' : '' ?>"
                        id="dropdownConfiguracion" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="bi bi-gear"></i> Configuración
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                        aria-labelledby="dropdownConfiguracion">
                        <?php if (tienePermiso('usuarios_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=usuarios"><i class="bi bi-person-badge"></i>
                                Usuarios</a></li><?php endif; ?>
                        <?php if (tienePermiso('roles_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=roles"><i class="bi bi-shield-check"></i>
                                Roles</a></li><?php endif; ?>
                        <?php if (tienePermiso('empresa_configurar')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=configuracion_empresa">
                                <i class="bi bi-building"></i> Empresa</a></li><?php endif; ?>
                        <?php if (tienePermiso('backup_ver')): ?>
                        <li><a class="dropdown-item" href="index.php?modulo=backup"><i class="bi bi-database"></i>
                                Backup y Restauración</a></li><?php endif; ?>
                        <li><a class="dropdown-item" href="index.php?modulo=bitacora">
                                <i class="bi bi-journal-text"></i> Bitácora</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>
        </div>


        <div class="col-md-10 p-4">