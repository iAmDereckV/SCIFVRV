<h2>Proveedores</h2>

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

<script src="assets/js/proveedores.js"></script>