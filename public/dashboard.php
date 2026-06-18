<?php
require_once __DIR__ . '/../app/middleware/AuthMiddleware.php';

AuthMiddleware::verificar();

?>

<?php include __DIR__ . '/../view/layouts/header.php'; ?>



<div class="d-flex">

    <div class="container-fluid p-4">
        <h2>Dashboard</h2>
        <h4>
            Bienvenido:
            <?= $_SESSION['nombre'] ?>
        </h4>

        <hr>

        <div class="row">

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Ventas Hoy</h5>

                        <h3 id="ventasHoy">
                            0
                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Productos</h5>

                        <h3 id="productos">
                            0
                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Clientes</h5>

                        <h3 id="clientes">
                            0
                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Facturas</h5>

                        <h3 id="facturas">
                            0
                        </h3>

                    </div>

                </div>

            </div>


            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Gastos Mes</h5>

                        <h3 id="gastosMes">
                            0
                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Utilidad</h5>

                        <h3 id="utilidadMes">
                            0
                        </h3>

                    </div>

                </div>

            </div>


            <div class="col-md-3">

                <div class="card">

                    <div class="card-body">

                        <h5>Ventas Mes</h5>

                        <h3 id="ventasMes">
                            0
                        </h3>

                    </div>



                </div>



            </div>
        </div>
        <hr>

        <div class="row">

            <div class="col-md-6">

                <canvas id="graficoVentas">
                </canvas>

            </div>

            <div class="col-md-6">

                <canvas id="graficoProductos">
                </canvas>

            </div>

        </div>

        <br>

        <div class="row">

            <div class="col-md-12">

                <canvas id="graficoStock">
                </canvas>

            </div>

        </div>




    </div>
</div>
<canvas id="graficoVentas"></canvas>
<script src="assets/js/dashboard.js"></script>


<!-- <?php include './../view/layouts/footer.php'; ?> -->