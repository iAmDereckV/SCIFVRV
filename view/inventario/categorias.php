<h2>Categorías</h2>

<form id="formCategoria">

    <input type="text" id="nombre" placeholder="Nombre Categoría" class="form-control mb-2" required>

    <textarea id="descripcion" placeholder="Descripción" class="form-control mb-2"></textarea>

    <button type="submit" class="btn btn-primary">

        Guardar

    </button>

</form>

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

<script src="assets/js/categorias.js"></script>