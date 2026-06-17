<h2>Marcas</h2>

<form id="formMarca">

    <input type="text" id="nombre" placeholder="Nombre Marca" class="form-control mb-2" required>

    <textarea id="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>

</form>

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

<script src="assets/js/marcas.js"></script>