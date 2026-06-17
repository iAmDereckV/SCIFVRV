<?php

require_once __DIR__ . '/../../app/helpers/Session.php';

Session::iniciar();

?>

<div class="container-fluid">

    <div class="row">

        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-md-2 min-vh-100">
            <img src="" width=" 80" id="navlogo" class="rounded-circle  me-2" alt="logo_empresa">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item ">
                    <a href="index.php" class="nav-link text-white <?= $modulo == 'dashboard' ? 'active' : '' ?>"
                        aria-current="page">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $inventarioActivo ? 'active' : '' ?>"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-boxes"></i> Inventario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="index.php?modulo=productos"><i class="bi bi-box-seam"></i>
                                Productos</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=marcas"><i class="bi bi-bookmark-star"></i>
                                Marcas</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=categorias"><i class="bi bi-tags"></i>
                                Categorías</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=kardex"><i class="bi bi-journal-text"></i>
                                Kardex</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?modulo=clientes"
                        class="nav-link  text-white <?= $modulo == 'clientes' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?modulo=proveedores"
                        class="nav-link  text-white <?= $modulo == 'proveedores' ? 'active' : '' ?>"
                        aria-current="page">
                        <i class="bi bi-box2-heart"></i> Proveedor
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?modulo=ventas"
                        class="nav-link  text-white <?= $modulo == 'ventas' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-cart-check"></i> Ventas
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?modulo=gastos"
                        class="nav-link  text-white <?= $modulo == 'gastos' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-cash-stack"></i> Gastos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?modulo=compras"
                        class="nav-link  text-white <?= $modulo == 'compras' ? 'active' : '' ?>" aria-current="page">
                        <i class="bi bi-bag-plus"></i> Compras
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $reporteActivo ? 'active' : '' ?>"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bar-chart-line"></i> Reportes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_ventas"><i
                                    class="bi bi-cart-check"></i>
                                Ventas</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_gastos"><i
                                    class="bi bi-cash-stack"></i>
                                Gastos</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=reportes_compras"><i
                                    class="bi bi-bag-plus"></i>
                                Compras</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=maestro_detalle"><i
                                    class="bi bi-card-list"></i>
                                Detalle Maestro</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=excel"><i class="bi bi-download"></i>
                                Excel</a></li>

                    </ul>
                </li>

            </ul>
            <hr>
            <?php if ($_SESSION['rol'] == 1): ?>
            <ul class="nav nav-pills flex-column">
                <li>
                    <a href="#" class="nav-link text-white dropdown-toggle <?= $configActivo ? 'active' : '' ?>"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                        <i class="bi bi-gear"></i> Configuración
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="index.php?modulo=usuarios"><i class="bi bi-person-badge"></i>
                                Usuarios</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=roles"><i class="bi bi-shield-check"></i>
                                Roles</a></li>

                        <li><a class="dropdown-item" href="index.php?modulo=configuracion_empresa">
                                <i class="bi bi-building"></i> Empresa</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=backup"><i class="bi bi-database"></i>
                                Backup y Restauración</a></li>
                        <li><a class="dropdown-item" href="index.php?modulo=bitacora">
                                <i class="bi bi-journal-text"></i> Bitácora</a></li>
                    </ul>
                </li>
            </ul>
            <?php endif; ?>
        </div>


        <div class="col-md-10 p-4">