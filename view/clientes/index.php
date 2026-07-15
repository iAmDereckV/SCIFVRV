<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold mb-0">
        Clientes
    </h2>

    <button class="btn btn-primary" onclick="nuevoCliente()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Cliente

    </button>

</div>
<div class="modal fade" id="modalCliente" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <form id="formCliente">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-box-seam text-white"></i>

                        Cliente

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

                            <input type="text" id="nombres" class="form-control" placeholder="Nombre del cliente">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Apellido
                            </label>

                            <input type="text" id="apellidos" class="form-control" placeholder="Apellido del cliente">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Identificacion
                            </label>
                            <input type="text" id="identificacion" class="form-control" placeholder="Identificacion">
                        </div>
                        <div class="col-md-4">

                            <label class="form-label">
                                <i class="bi bi-bookmark-star"></i>
                                Tipo Cliente
                            </label>

                            <select id="tipo_cliente" class="form-select">

                            </select>

                        </div>
                        <div class="col-md-8">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Correo
                            </label>
                            <input type="email" id="correo" class="form-control" placeholder="Correo">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Telefono
                            </label>
                            <input type="text" id="telefono" class="form-control" placeholder="Telefono">
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

                        Guardar Cliente

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<hr>

<table class="table table-hover align-middle" id="tablaClientes">

    <thead>

        <tr>

            <th>ID</th>
            <th>Cliente</th>
            <th>Identificación</th>
            <th>Teléfono</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>
<script>
    const PUEDE_EDITAR_CLIENTES =
        <?= tienePermiso('clientes_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_CLIENTES =
        <?= tienePermiso(
            'clientes_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_CLIENTES =
        <?= tienePermiso('clientes_eliminar')
            ? 'true'
            : 'false' ?>;
</script>

<script src="assets/js/clientes.js"></script>