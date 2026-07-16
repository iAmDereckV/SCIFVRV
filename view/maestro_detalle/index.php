<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="page-title ">

        Maestro Detalle

    </h2>

    <button
        id="btnExcel"
        class="btn btn-success">

        <i class="bi bi-file-earmark-excel"></i>

        Exportar Excel

    </button>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-end">

            <div class="col-md-4">

                <label class="form-label">

                    Año

                </label>

                <select
                    id="anio"
                    class="form-select">

                </select>

            </div>

            <div class="col-md-3">

                <button
                    class="btn btn-primary w-100"
                    onclick="cargarResumen()">

                    <i class="bi bi-search"></i>

                    Consultar

                </button>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="table-responsive">

            <table
                id="tablaMaestroDetalle"
                class="table table-hover table-bordered align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Concepto</th>

                        <th>Ene</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Abr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Ago</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dic</th>

                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                </tbody>

            </table>

        </div>

    </div>

</div>
<script>
    const PUEDE_EXPORTAR_EXCEL =
        <?= tienePermiso(
            'excel_exportar'
        ) ? 'true' : 'false' ?>;
</script>


<script src="assets/js/maestro_detalle.js"></script>