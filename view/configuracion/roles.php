<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="page-title mb-0">
        Roles
    </h2>

    <button class="btn btn-primary" onclick="nuevoRol()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Rol

    </button>

</div>
<div class="modal fade" id="modalRol" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">
            <form id="formRol">
                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-shield-check"></i>

                        Rol

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>
                <div class="modal-body">

                    <div class="row g-3">



                        <div class="col-md-12">
                            <label class="form-label">
                                <i class="bi bi-shield-check"></i>
                                Nombre
                            </label>

                            <input type="text" id="nombre" required class="form-control" placeholder="Nombre del rol">
                        </div>
                        <div class="col-md-12">

                            <label class="form-label"><i class="bi bi-card-text"></i>
                                Descripción
                            </label>

                            <textarea id="descripcion" class="form-control" rows="3"></textarea>

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

                        Guardar Rol

                    </button>

                </div>
            </form>
        </div>

    </div>

</div>


<hr>

<table class="table table-hover align-middle" id="tablaRoles">

    <thead>

        <tr>

            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>


<div class="modal fade" id="modalPermisos" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Permisos del Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>
            <div class="modal-body">



                <div id="listaPermisos"></div>

            </div>
            <div class="modal-body">

                <div id="listaPermisos"></div>

            </div>

            <div class="modal-footer">
                <div class="d-flex justify-content-end gap-2 mb-3">

                    <button
                        type="button"
                        class="btn btn-outline-success btn-sm"
                        onclick="seleccionarTodos()">

                        <i class="bi bi-check2-square"></i>

                        Seleccionar todos

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-danger btn-sm"
                        onclick="quitarTodos()">

                        <i class="bi bi-x-square"></i>

                        Quitar todos

                    </button>

                    <button class="btn btn-outline-primary btn-sm" onclick="guardarPermisos()">
                        <i class="bi bi-check-circle"></i>
                        Guardar

                    </button>
                </div>

            </div>

        </div>

    </div>

</div>
<script>
    const PUEDE_EDITAR_ROLES =
        <?= tienePermiso('roles_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_ROLES =
        <?= tienePermiso(
            'roles_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_ROLES =
        <?= tienePermiso('roles_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/roles.js"></script>