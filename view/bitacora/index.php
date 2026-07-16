<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">

            <i class="bi bi-clock-history text-primary"></i>

            Bitácora General

        </h2>

        <button
            class="btn btn-success"
            onclick="exportarBitacora()">

            <i class="bi bi-file-earmark-excel"></i>

            Exportar Excel

        </button>

    </div>

    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <small>

                        Total Registros

                    </small>

                    <h3 id="totalRegistros">

                        0

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <small>

                        Entradas

                    </small>

                    <h3
                        class="text-success"
                        id="totalEntradas">

                        0

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <small>

                        Salidas

                    </small>

                    <h3
                        class="text-danger"
                        id="totalSalidas">

                        0

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <small>

                        Usuarios

                    </small>

                    <h3 id="totalUsuarios">

                        0

                    </h3>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="tablaBitacora"
                    class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Fecha</th>

                            <th>Tipo</th>

                            <th>Referencia</th>

                            <th>Descripción</th>

                            <th>Entrada</th>

                            <th>Salida</th>

                            <th>Usuario</th>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>
    const PUEDE_EXPORTAR_EXCEL =
        <?= tienePermiso('excel_exportar') ? 'true' : 'false' ?>;
</script>

<script src="assets/js/bitacora.js"></script>