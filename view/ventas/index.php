<div class="container-fluid">
    <h3 class="page-title mb-4 "><i class="bi bi-cart-check-fill text-primary"></i>Nueva Venta</h3>
    <div class="row">
        <!-- IZQUIERDA -->
        <div class="col-lg-8">
            <!-- Cliente -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person-fill text-primary"></i>Cliente</h5>
                </div>
                <div class="card-body">
                    <select id="cliente_id" class="form-select"></select>
                </div>
            </div>
            <!-- Productos -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-box-seam text-success"></i>Agregar Producto</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <label class="form-label">Producto</label>
                            <select id="producto_id" class="form-select"></select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Cantidad</label>
                            <input id="cantidad" type="number" value="1" min="1" class="form-control">
                        </div>
                        <div class="col-md-3 d-grid">
                            <label>&nbsp;</label>
                            <button class="btn btn-success" onclick="agregarProducto()">
                                <i class="bi bi-plus-circle"></i>Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detalle -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-receipt"></i>Detalle de la Venta</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaDetalle">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cant.</th>
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
        <!-- DERECHA -->
        <div class="col-lg-4">
            <div class="card shadow border-0 rounded-4 sticky-top">
                <div class="card-header card-bg text-white text-center">
                    <h4 class="mb-0">Resumen</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Tipo Descuento</label>
                        <select id="tipo_descuento" class="form-select">
                            <option value="porcentaje">%</option>
                            <option value="monto">C$</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Descuento</label>
                        <input id="descuento_valor" type="number" value="0" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>IVA %</label>
                        <input id="porcentaje_impuesto" value="15" class="form-control">
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong id="subtotal">0.00</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Descuento</span>
                        <strong class="text-danger" id="descuento">0.00</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>IVA</span>
                        <strong id="impuesto">0.00</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h4>Total</h4>
                        <h3 class="fw-bold text-success" id="total">C$0.00</h3>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-success btn-lg" onclick="guardarVenta()">
                            <i class="bi bi-check-circle"></i>Finalizar Venta
                        </button>
                        <button class="btn btn-outline-secondary">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const PUEDE_CREAR_VENTAS =
    <?= tienePermiso('ventas_crear') ? 'true' : 'false' ?>;
</script>
<script src="assets/js/ventas.js"></script>