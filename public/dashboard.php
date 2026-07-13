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
            <!-- //? CARD -->
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
                                <i class="bi bi-cart-check fs-1 text-success"></i>
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
                                <i class="bi bi-graph-up-arrow fs-1 text-primary"></i>
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
                                <i class="bi bi-cart-plus fs-1 text-info"></i>
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
                                <i class="bi bi-cash-coin fs-1 text-warning"></i>
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
                                <i class="bi bi-box-seam fs-1 text-dark"></i>
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
                                <i class="bi bi-people-fill fs-1 text-secondary"></i>
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
                                <i class="bi bi-receipt fs-1 text-primary"></i>
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
            <!--//? Resumen Financiero  -->
            <div class="card shadow-sm border-0 mt-4">

                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        Resumen Financiero
                    </h5>
                </div>

                <div class="card-body">

                    <div class="row text-center">

                        <div class="col-md-3">

                            <small class="text-muted">
                                Ventas
                            </small>

                            <h4 id="rfVentas" class="text-success">
                                C$ 0.00
                            </h4>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Costos
                            </small>

                            <h4 id="rfCostos" class="text-warning">
                                C$ 0.00
                            </h4>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Gastos
                            </small>

                            <h4 id="rfGastos" class="text-danger">
                                C$ 0.00
                            </h4>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted">
                                Utilidad
                            </small>

                            <h4 id="rfUtilidad" class="text-primary">
                                C$ 0.00
                            </h4>

                        </div>

                    </div>

                </div>

            </div>
            <!-- //? Graficos -->
            <div class="row mt-4">

                <div class="col-lg-6">
                    <div class="card-header fw-bold">

                        Ventas vs Compras

                    </div>

                    <div class="card-body">

                        <canvas id="graficoVentas"></canvas>

                    </div>


                </div>
                <div class="col-lg-6">

                    <div class="card-header fw-bold">


                        Stock crítico
                    </div>

                    <div class="card-body">

                        <canvas id="graficoStock"></canvas>

                    </div>

                </div>


            </div>

            <div class="row mt-4">
                <div class="col-lg-6">

                    <div class="card-header fw-bold">

                        Top productos vendidos

                    </div>

                    <div class="card-body">

                        <canvas id="graficoProductos"></canvas>

                    </div>

                </div>


                <div class="col-lg-6">

                    <div class="card-header fw-bold">

                        Ventas por vendedor

                    </div>

                    <div class="card-body">

                        <canvas id="graficoVendedores"></canvas>

                    </div>

                </div>
            </div>
            <!-- //? tablas -->
            <div class="col-lg-6">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">
                            <i class="bi bi-exclamation-triangle text-warning"></i>
                            Productos con Stock Bajo
                        </h6>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover table-sm mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Producto</th>
                                    <th>Stock</th>
                                    <th>Mínimo</th>

                                </tr>

                            </thead>

                            <tbody id="tablaStockBajo">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            <div class="col-lg-6">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">
                            <i class="bi bi-receipt text-success"></i>
                            Últimas Ventas
                        </h6>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover table-sm mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody id="tablaUltimasVentas">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            <div class="col-lg-6 mt-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">
                            <i class="bi bi-cart-check text-primary"></i>
                            Últimas Compras
                        </h6>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover table-sm mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody id="tablaUltimasCompras">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>
            <div class="col-lg-6 mt-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h6 class="mb-0">
                            <i class="bi bi-clock-history text-secondary"></i>
                            Actividad Reciente
                        </h6>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover table-sm mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>Hora</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>

                                </tr>

                            </thead>

                            <tbody id="tablaActividad">

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>



        </div>
    </div>

    <script src="assets/js/dashboard.js"></script>


    <!-- <?php include './../view/layouts/footer.php'; ?> -->