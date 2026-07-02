<h2>Usuarios</h2>

<form id="formUsuario">

    <input type="hidden" id="id" placeholder="Id" class="form-control mb-2">
    <input type="text" id="nombre" placeholder="Nombre" class="form-control mb-2">

    <input type="text" id="usuario" placeholder="Usuario" class="form-control mb-2">

    <input type="email" id="correo" placeholder="Correo" class="form-control mb-2">

    <input type="password" id="password" placeholder="Contraseña" class="form-control mb-2">
    <label>Foto</label>

    <input type="file" id="imagen" class="form-control">

    <img id="previewFoto" width="120" class="mt-2">
    <select id="rol_id" class="form-control mb-2">
    </select>

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>

</form>

<hr>

<table class="table" id="tablaUsuarios">

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