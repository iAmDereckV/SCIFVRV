<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="page-title mb-0">
        Usuario
    </h2>

    <button class="btn btn-primary" onclick="nuevoUsuario()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Usuario

    </button>

</div>
<div class="modal fade" id="modalUsuario" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <form id="formUsuario">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-person-badge"></i>

                        Usuario

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label"><i class="bi bi-person"></i>
                                Nombre
                            </label>
                            <input type="text" id="nombre" required class="form-control" placeholder="Nombre del usuario">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-person-badge"></i>
                                Usuario
                            </label>
                            <input type="text" id="usuario" required class="form-control" placeholder="Usuario">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="bi bi-key"></i>
                                Contraseña
                            </label>
                            <input type="password" id="password" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">
                                <i class="bi bi-envelope-at"></i>
                                Correo
                            </label>
                            <input type="email" id="correo" class="form-control" placeholder="Correo">
                        </div>
                        <div class="col-md-4">

                            <label class="form-label">
                                <i class="bi bi-person-gear"></i>
                                Rol
                            </label>

                            <select id="rol_id" required class="form-select">
                            </select>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label">
                                <i class="bi bi-camera"></i>
                                Imagen
                            </label>

                            <input type="file" id="imagen" class="form-control" accept="image/*">

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

                        Guardar Usuario

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<hr>

<table class="table table-hover align-middle" id="tablaUsuarios">

    <thead>
        <tr>
            <th>ID</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody></tbody>

</table>
<div class=" modal fade" id="modalImagen">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Cambiar Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="usuario_imagen_id">

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
    const PUEDE_EDITAR_USUARIOS =
        <?= tienePermiso('usuarios_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_USUARIOS =
        <?= tienePermiso(
            'usuarios_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_USUARIOS =
        <?= tienePermiso('usuarios_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/usuarios.js"></script>