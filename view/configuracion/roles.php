<?php
// echo __DIR__ . '../app/middleware/AuthMiddleware.php';
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

            </tr>

        </thead>

        <tbody></tbody>

    </table>

</div>

<script src="assets/js/roles.js"></script>