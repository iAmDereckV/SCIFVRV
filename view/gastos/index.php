<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="page-title mb-0">Control de Gastos</h2>
    <button class="btn btn-primary" onclick="nuevoGasto()">
        <i class="bi bi-plus-circle"></i>Nuevo Gasto
    </button>
</div>
<div class="modal fade" id="modalGasto" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form id="formGasto">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-cash-stack"></i>Gasto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-tags"></i>Categoría Gasto</label>
                            <div class="input-group">
                                <select id="categoria_id" required class="form-select"></select>
                                <button type="button" class="btn btn-success" onclick="nuevaCategoria()"
                                    title="Nueva categoría">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                                <button type="button" class="btn btn-warning" onclick="editarCategoria()"
                                    title="Editar categoría">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="bi bi-cash-stack"></i>Monto</label>
                            <input type="number" required id="monto" step="0.01" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label"><i class="bi bi-calendar-event"></i>Fecha</label>
                            <input type="date" required id="fecha" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-card-text"></i>Descripción</label>
                            <textarea id="descripcion" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-image"></i>Imagen</label>
                            <input type="file" id="archivo_factura" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-clockwise"></i>Limpiar
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>Guardar Gasto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-hover table-sm align-middle" id="tablaGastos">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Usuario</th>
                <th>Comprobante</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div class="modal fade" id="modalImagen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Cambiar Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="gasto_imagen_id">
                <input type="file" id="nueva_imagen" class="form-control" accept="image/*">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="guardarImagen()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalCategoriaGasto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCategoria">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Categoría de Gasto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label"><i class="bi bi-tags"></i>Nombre</label>
                    <input id="nombreCategoria" required class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
const PUEDE_EDITAR_GASTOS =
    <?= tienePermiso('gastos_editar') ? 'true' : 'false' ?>;
const PUEDE_CREAR_GASTOS =
    <?= tienePermiso('gastos_crear') ? 'true' : 'false' ?>;
</script>
<script src="assets/js/gastos.js"></script>