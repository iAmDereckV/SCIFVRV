<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title ">
        Reporte de Compras
    </h2>
    <button
        class="btn btn-success" onclick="exportarExcelCompras()">
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
                    onclick="buscarCompras()">

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

                    Compras

                </small>

                <h3 id="cantidadCompras">

                    0

                </h3>

            </div>

        </div>

    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <small>
                    Total Comprado
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

                    Promedio por Compra

                </small>

                <h3
                    id="promedioCompra">

                    C$0.00

                </h3>

            </div>

        </div>

    </div>
    <div class="col-md-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body text-center">

                <small>

                    Compra mayor

                </small>

                <h3
                    id="compraMayor">

                    C$0.00

                </h3>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">
        <table id="tablaCompras" class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>Compra</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Usuario</th>
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
<div class="modal fade" id="modalImagen">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Cambiar Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="compra_imagen_id">

                <input type="file" id="nueva_imagen" class="form-control" accept="image/*">

            </div>

            <div class="modal-footer">

                <button class="btn btn-primary" onclick="guardarImagen()">

                    Guardar

                </button>

            </div>

        </div>

    </div>

</div>
<script>
    const PUEDE_CAMBIAR_ESTADO_COMPRAS =
        <?= tienePermiso('compras_anular')
            ? 'true'
            : 'false' ?>;
    const PUEDE_EXPORTAR_EXCEL =
        <?= tienePermiso(
            'excel_exportar'
        ) ? 'true' : 'false' ?>;
    const PUEDE_EDITAR_COMPRAS =
        <?= tienePermiso('compras_editar') ? 'true' : 'false' ?>;
</script>
<script src="assets/js/reportes.js"></script>