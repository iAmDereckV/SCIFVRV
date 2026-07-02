<h2>Categorías</h2>
<?php if (
    tienePermiso('categorias_crear')
    ||
    tienePermiso('categorias_editar')
): ?>
<form id="formCategoria">

    <input type="text" id="nombre" placeholder="Nombre Categoría" class="form-control mb-2" required>

    <textarea id="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>

    <button type="submit" class="btn btn-primary">

        Guardar

    </button>

</form>
<?php endif; ?>
<hr>

<table class="table" id="tablaCategorias">

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