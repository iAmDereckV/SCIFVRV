<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="fw-bold mb-0">
        Marcas
    </h2>

    <button class="btn btn-primary" onclick="nuevaMarca()">

        <i class="bi bi-plus-circle"></i>
        Nueva Marca

    </button>

</div>
<div class="modal fade" id="modalMarca" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">
            <form id="formMarca">
                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-bookmark-star text-white"></i>

                        Marca

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

                            <input type="text" id="nombre" class="form-control" placeholder="Nombre de la marca">
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

                        Guardar Marca

                    </button>

                </div>
            </form>
        </div>

    </div>

</div>
<hr>

<table class="table table-hover align-middle" id="tablaMarcas">

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
    const PUEDE_EDITAR_MARCAS =
        <?= tienePermiso('marcas_editar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_CREAR_MARCAS =
        <?= tienePermiso(
            'marcas_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_MARCAS =
        <?= tienePermiso('marcas_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/marcas.js"></script>