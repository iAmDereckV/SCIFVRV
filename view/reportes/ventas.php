<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="page-title ">

        Reporte de Ventas

    </h2>

    <button
        class="btn btn-success" onclick="exportarExcelVentas()">

        <i class="bi bi-file-earmark-excel"></i>

        Exportar Excel

    </button>

</div>
<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-end">

            <div class="col-md-4">

                <label class="form-label">

                    Desde

                </label>

                <input
                    type="date"
                    id="fecha_inicio"
                    class="form-control">

            </div>

            <div class="col-md-4">

                <label class="form-label">

                    Hasta

                </label>

                <input
                    type="date"
                    id="fecha_fin"
                    class="form-control">

            </div>

            <div class="col-md-4">

                <button
                    class="btn btn-primary w-100"
                    onclick="buscarVentas()">

                    <i class="bi bi-search"></i>

                    Buscar

                </button>

            </div>

        </div>

    </div>

</div>
<div class="row mb-4">

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <small>

                    Facturas

                </small>

                <h3 id="cantidadVentas">

                    0

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <small>

                    Total Vendido

                </small>

                <h3
                    id="totalGeneral"
                    class="text-success">

                    C$0.00

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <small>

                    Promedio por Venta

                </small>

                <h3
                    id="promedioVenta">

                    C$0.00

                </h3>

            </div>

        </div>

    </div>
    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <small>

                    Venta mayor

                </small>

                <h3
                    id="ventaMayor">

                    C$0.00

                </h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <table
            id="tablaVentas"
            class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>Factura</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

    </div>

</div>

<script>
    const PUEDE_CAMBIAR_ESTADO_VENTAS =
        <?= tienePermiso(
            'ventas_anular'
        ) ? 'true' : 'false' ?>;
    const PUEDE_EXPORTAR_EXCEL =
        <?= tienePermiso(
            'excel_exportar'
        ) ? 'true' : 'false' ?>;
</script>
<script src="assets/js/reportes.js"></script>