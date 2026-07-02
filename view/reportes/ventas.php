<h2>Reporte de Ventas</h2>

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
        <button class="btn btn-primary" onclick="buscarVentas()">
            Buscar
        </button>
    </div>

</div>

<hr>

<table class="table table-bordered">

    <thead>

        <tr>
            <th>Factura</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Vendedor</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Anular</th>
            <th>Ver Factura</th>
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
<script>
    const PUEDE_CAMBIAR_ESTADO_VENTAS =
        <?= tienePermiso(
            'ventas_anular'
        ) ? 'true' : 'false' ?>;
</script>
<script src="assets/js/reportes.js"></script>