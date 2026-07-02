<h2>Proveedores</h2>
<?php if (
    tienePermiso('proveedores_crear')
    ||
    tienePermiso('proveedores_editar')
): ?>
<form id="formProveedor">

    <input type="text" id="nombre" class="form-control mb-2" placeholder="Nombre">

    <input type="text" id="contacto" class="form-control mb-2" placeholder="Contacto">

    <input type="text" id="telefono" class="form-control mb-2" placeholder="Teléfono">

    <input type="email" id="correo" class="form-control mb-2" placeholder="Correo">

    <textarea id="direccion" class="form-control mb-2" placeholder="Dirección"></textarea>

    <button class="btn btn-primary">
        Guardar
    </button>

</form>
<?php endif; ?>
<hr>

<table class="table" id="tablaProveedores">

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