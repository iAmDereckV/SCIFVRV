<h2>Clientes</h2>

<form id="formCliente">

    <input type="text" id="nombres" class="form-control mb-2" placeholder="Nombres">

    <input type="text" id="apellidos" class="form-control mb-2" placeholder="Apellidos">

    <input type="text" id="identificacion" class="form-control mb-2" placeholder="Identificación">

    <input type="text" id="telefono" class="form-control mb-2" placeholder="Teléfono">

    <input type="email" id="correo" class="form-control mb-2" placeholder="Correo">

    <textarea id="direccion" class="form-control mb-2" placeholder="Dirección"></textarea>

    <select id="tipo_cliente" class="form-control mb-2">

        <option value="NORMAL">NORMAL</option>
        <option value="TALLER">TALLER</option>
        <option value="EMPRESA">EMPRESA</option>

    </select>

    <button type="submit" class="btn btn-primary">

        Guardar

    </button>

</form>

<hr>

<table class="table table-bordered" id="tablaClientes">

    <thead>

        <tr>

            <th>ID</th>
            <th>Cliente</th>
            <th>Identificación</th>
            <th>Teléfono</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>

<script src="assets/js/clientes.js"></script>