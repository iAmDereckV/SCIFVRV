<div class="container-fluid">
    <h3 class="page-title mb-4">
        <i class="bi bi-cart-plus-fill text-primary"></i>Nueva Compra
    </h3>
    <div class="row">
        <div class="col-lg-8">
            <!-- Datos compra -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-bag-plus text-primary"></i>Datos de la Compra
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Proveedor</label>
                            <select id="proveedor_id" class="form-select"></select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Factura</label>
                            <input id="factura" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Archivo</label>
                            <input type="file" id="archivo_factura" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-cart-plus text-success"></i>Agregar Productos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label">Producto</label>
                            <select id="producto_id" class="form-select"></select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Cantidad</label>
                            <input type="number" id="cantidad" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Costo Unidad</label>
                            <input type="number" step="0.01" id="costo" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success w-100" onclick="agregarProducto()">
                                <i class="bi bi-plus-circle"></i>Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header card-bg text-white text-center">
                    <h4 class="mb-0">Resumen</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Productos</span>
                        <strong id="cantidadProductos">0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Unidades</span>
                        <strong id="cantidadUnidades">0</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4>Total</h4>
                        <h3 class="fw-bold text-primary" id="total">C$ 0.00</h3>
                    </div>
                    <button class="btn btn-primary w-100 mt-3" onclick="guardarCompra()">
                        <i class="bi bi-check-circle"></i>Guardar Compra
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <!-- Tabla detalle -->
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-list-check"></i>Detalle de la Compra
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaDetalle">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Costo</th>
                                    <th>Subtotal</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const PUEDE_CREAR_COMPRAS =
    <?= tienePermiso('compras_crear') ? 'true' : 'false' ?>;
</script>
<script src="assets/js/compras.js"></script>