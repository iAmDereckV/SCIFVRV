<h2>Control de Gastos</h2>

<form id="formGasto">
    <select id="categoria_id" class="form-control mb-2">

    </select>

    <textarea id="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>

    <input type="number" step="0.01" id="monto" class="form-control mb-2" placeholder="Monto">

    <input type="date" id="fecha" class="form-control mb-2">
    <label>Comprobante</label>

    <input type="file" id="archivo_factura" class="form-control mb-2">
    <button type="submit" class="btn btn-primary">

        Guardar

    </button>

</form>

<hr>

<table class="table">

    <thead>

        <tr>

            <th>Fecha</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Usuario</th>
            <th>Comprobante</th>

            <th>Acciones</th>

        </tr>

    </thead>

    <tbody id="tbodyGastos">

    </tbody>

</table>

<script src="assets/js/gastos.js"></script>