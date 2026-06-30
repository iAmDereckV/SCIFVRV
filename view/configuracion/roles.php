<?= tienePermiso('roles_ver') ? '' : header("Location: index.php"); ?>
<?php

require_once __DIR__ . '/../../app/middleware/AuthMiddleware.php';


AuthMiddleware::verificar();

?>

<div class="container mt-4">

    <h3>Roles</h3>

    <form id="formRol">

        <input type="hidden" id="id">

        <div class="mb-3">

            <label>Nombre</label>

            <input type="text" id="nombre" class="form-control">

        </div>

        <div class="mb-3">

            <label>Descripción</label>

            <textarea id="descripcion" class="form-control">
            </textarea>

        </div>

        <button class="btn btn-primary">

            Guardar

        </button>

    </form>

    <hr>

    <table class="table" id="tablaRoles">

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

                </div>

                <div class="modal-body">

                    <div id="listaPermisos"></div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary" onclick="guardarPermisos()">

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