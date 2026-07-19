<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title "><i class="bi bi-file-earmark-excel-fill text-success"></i>Centro de Reportes</h2>
</div>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-box-seam fs-1 text-success"></i>
                <h5 class="mt-3">Inventario</h5>
                <button class="btn btn-success w-100 mt-3" onclick="exportarInventario()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-people-fill fs-1 text-info"></i>
                <h5 class="mt-3">Clientes</h5>
                <button class="btn btn-info w-100 mt-3" onclick="exportarClientes()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-truck fs-1 text-warning"></i>
                <h5 class="mt-3">Proveedores</h5>
                <button class="btn btn-warning w-100 mt-3" onclick="exportarProveedores()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-cash-stack fs-1 text-warning"></i>
                <h5 class="mt-3">Gastos</h5>
                <button class="btn btn-warning w-100 mt-3" onclick="exportarGastos()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-receipt fs-1 text-primary"></i>
                <h5 class="mt-3">Ventas</h5>
                <button class="btn btn-primary w-100 mt-3" onclick="exportarVentas()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-list-ul fs-1 text-danger"></i>
                <h5 class="mt-3">Ventas Detalladas</h5>
                <button class="btn btn-danger w-100 mt-3" onclick="exportarVentasDetalladas()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-cart-plus fs-1 text-secondary"></i>
                <h5 class="mt-3">Compras</h5>
                <button class="btn btn-secondary w-100 mt-3" onclick="exportarCompras()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-card-checklist fs-1 text-dark"></i>
                <h5 class="mt-3">Compras Detalladas</h5>
                <button class="btn btn-dark w-100 mt-3" onclick="exportarComprasDetalladas()">
                    <i class="bi bi-file-earmark-excel"></i>Exportar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
const PUEDE_EXPORTAR_EXCEL =
    <?= tienePermiso('excel_exportar') ? 'true' : 'false' ?>;
</script>
<script src="assets/js/reportes.js"></script>