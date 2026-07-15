<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="mb-0">
        Proveedores
    </h2>

    <button class="btn btn-primary" onclick="nuevoProveedor()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Proveedor

    </button>

</div>
<div class="modal fade" id="modalProveedor" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <form id="formProveedor">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-box-seam text-white"></i>

                        Proveedores

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Nombre
                            </label>

                            <input type="text" id="nombre" class="form-control" placeholder="Nombre Del Proveedor">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Contacto
                            </label>

                            <input type="text" id="contacto" class="form-control" placeholder="Nombre del Encargado">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Telefono
                            </label>
                            <input type="text" id="telefono" class="form-control" placeholder="Telefono">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Correo
                            </label>
                            <input type="email" id="correo" class="form-control" placeholder="Correo">
                        </div>

                        <div class="col-md-12">

                            <label class="form-label">
                                Direccion
                            </label>

                            <textarea id="direccion" class="form-control" rows="3"></textarea>

                        </div>
                    </div>


                </div>

                <div class="modal-footer">

                    <button type="reset" class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Limpiar

                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle"></i>

                        Cancelar

                    </button>

                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>

                        Guardar Proveedor

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<hr>

<table class="table table-hover align-middle" id="tablaProveedores">

    <thead>

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>
<script>
    const PUEDE_EDITAR_PROVEEDORES =
        <?= tienePermiso('proveedores_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_PROVEEDORES =
        <?= tienePermiso(
            'proveedores_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_PROVEEDORES =
        <?= tienePermiso('proveedores_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/proveedores.js"></script>