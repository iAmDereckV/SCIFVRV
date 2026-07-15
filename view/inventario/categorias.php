<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="mb-0">
        Categoría
    </h2>

    <button class="btn btn-primary" onclick="nuevoCategoria()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Categoría

    </button>

</div>
<div class="modal fade" id="modalCategoria" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <form id="formCategoria">
                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-tags text-white"></i>

                        Categoria

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>
                <div class="modal-body">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">
                                <i class="bi bi-box"></i>
                                Nombre
                            </label>

                            <input type="text" id="nombre" class="form-control" placeholder="Nombre de la categoria">
                        </div>
                        <div class="col-md-12">

                            <label class="form-label">
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

                        Guardar Categoria

                    </button>

                </div>

            </form>
        </div>

    </div>

</div>
<hr>

<table class="table table-hover align-middle" id="tablaCategorias">

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
<script>
    const PUEDE_EDITAR_CATEGORIAS =
        <?= tienePermiso('categorias_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_CATEGORIAS =
        <?= tienePermiso(
            'categorias_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_CATEGORIAS =
        <?= tienePermiso('categorias_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/categorias.js"></script>