<?php
require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

AuthMiddleware::verificar();

?>

<?php include __DIR__ . '/../view/layouts/header.php'; ?>



<div class="d-flex bg-light">

    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">

                    Dashboard

                </h2>

                <p class="text-muted mb-0">

                    Bienvenido,
                    <strong><?= $_SESSION['nombre'] ?></strong>

                </p>

            </div>

            <div class="text-end">

                <span class="badge bg-primary fs-6">

                    <?= date('d/m/Y') ?>

                </span>

            </div>

        </div>
        <div class="row g-3 mb-3">
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Ventas Hoy
                                </small>
                                <h3 id="ventasHoy" class="fw-bold text-success mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-cart-check fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Ventas Mes
                                </small>
                                <h3 id="ventasMes" class="fw-bold text-primary mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-graph-up-arrow fs-1 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Compras Mes
                                </small>
                                <h3 id="compras_mes" class="fw-bold text-info mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-cart-plus fs-1 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Utilidad Mes
                                </small>
                                <h3 id="utilidadMes" class="fw-bold text-warning mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-cash-coin fs-1 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Productos
                                </small>
                                <h3 id="productos" class="fw-bold text-dark mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-box-seam fs-1 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Cliente
                                </small>
                                <h3 id="clientes" class="fw-bold text-secondary mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-people-fill fs-1 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Facturas
                                </small>
                                <h3 id="facturas" class="fw-bold text-primary mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-receipt fs-1 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    Stock Critico
                                </small>
                                <h3 id="stock_bajo" class="fw-bold text-danger mt-2">
                                    C$ 0
                                </h3>
                            </div>
                            <div class="align-self-center">
                                <i class="bi bi-exclamation-triangle-fill fs-1 text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Resumen Financiero
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            Ventas
                        </div>
                        <div class="col-md-3">
                            Compras
                        </div>
                        <div class="col-md-3">
                            Gastos
                        </div>
                        <div class="col-md-3">
                            Utilidad
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-4">

                <div class="col-lg-6">
                    <div class="card-header fw-bold">

                        Ventas mensuales

                    </div>

                    <div class="card-body">

                        <canvas id="graficoVentas"></canvas>

                    </div>


                </div>

                <div class="col-lg-6">

                    <div class="card-header fw-bold">

                        Productos Mas Vendido

                    </div>

                    <div class="card-body">

                        <canvas id="graficoStock"></canvas>

                    </div>

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-lg-6">

                    <div class="card-header fw-bold">

                        Compras Mensuales

                    </div>

                    <div class="card-body">

                        <canvas id="graficoProductos"></canvas>

                    </div>

                </div>

                <div class="col-lg-6">

                    gastos Por Categorias

                </div>

            </div>
            <hr>
            <div class="row mt-4">

                <div class="col-lg-6">

                    Productos con Stock Bajo

                </div>

                <div class="col-lg-6">

                    Últimas Ventas

                </div>

            </div>

            <div class="row mt-3">

                <div class="col-lg-6">

                    Últimas Compras

                </div>

                <div class="col-lg-6">

                    Actividad Reciente

                </div>

            </div>



        </div>
    </div>

    <script src="assets/js/dashboard.js"></script>


    <!-- <?php include './../view/layouts/footer.php'; ?> -->