<?= tienePermiso('marcas_ver') ? '' : header("Location: index.php"); ?>
<h2>Marcas</h2>
<?php if (
    tienePermiso('marcas_crear')
    ||
    tienePermiso('marcas_editar')
): ?>
<form id="formMarca">

    <input type="text" id="nombre" placeholder="Nombre Marca" class="form-control mb-2" required>

    <textarea id="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>

</form>
<?php endif; ?>
<hr>

<table class="table" id="tablaMarcas">

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