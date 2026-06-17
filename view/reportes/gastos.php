<h2>Reporte de Gastos</h2>

<div class="row">

    <div class="col-md-3">
        <label>Desde</label>
        <input type="date" id="fecha_inicio" class="form-control">
    </div>

    <div class="col-md-3">
        <label>Hasta</label>
        <input type="date" id="fecha_fin" class="form-control">
    </div>

    <div class="col-md-3">
        <br>
        <button class="btn btn-primary" onclick="buscarGastos()">
            Buscar
        </button>
    </div>

</div>

<hr>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>ID</th>
            <th>Fecha</th>
            <th>Categoría</th>
            <th>Descripción</th>
            <th>Usuario</th>
            <th>Monto</th>

        </tr>

    </thead>

    <tbody id="tbodyReporte">

    </tbody>

</table>

<h4>

    Total General:
    C$
    <span id="totalGeneral">

        0

    </span>

</h4>

<script src="assets/js/reportes.js"></script>