<?= tienePermiso('compras_crear') || tienePermiso('compras_ver')  ? '' : header("Location: index.php"); ?>
<?php if (
    tienePermiso('compras_crear')
): ?>
    <h2>Compras</h2>

    <div class="row">

        <div class="col-md-4">

            <label>Proveedor</label>

            <select id="proveedor_id" class="form-control mb-2">
            </select>

        </div>

        <div class="col-md-4">

            <label>Número Factura</label>

            <input type="text" id="factura" class="form-control mb-2">

            <label class="mt-2">
                Archivo Factura
            </label>

            <input type="file" id="archivo_factura" class="form-control" accept=".jpg,.jpeg,.png,.pdf">

        </div>

    </div>
    <hr>

    <div class="row">

        <div class="col-md-4">

            <label>Producto</label>

            <select id="producto_id" class="form-control">
            </select>

        </div>

        <div class="col-md-2">

            <label>Cantidad</label>

            <input type="number" id="cantidad" class="form-control">

        </div>

        <div class="col-md-2">

            <label>Costo</label>

            <input type="number" step="0.01" id="costo" class="form-control">

        </div>

        <div class="col-md-2">

            <label>&nbsp;</label>

            <button class="btn btn-success form-control" onclick="agregarProducto()">

                Agregar

            </button>

        </div>

    </div>
    <hr>

    <table class="table" id="tablaDetalle">

        <thead>

            <tr>

                <th>Producto</th>

                <th>Cantidad</th>

                <th>Costo</th>

                <th>Subtotal</th>

                <th></th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

    <h4>

        Total:
        C$
        <span id="total">
            0.00
        </span>

    </h4>

    <button class="btn btn-primary" onclick="guardarCompra()">

        Guardar Compra

    </button>
    <hr>

<?php endif; ?>
<?php if (
    tienePermiso('compras_ver')
): ?>

    <h3>Historial de Compras</h3>

    <table class="table" id="tablaCompras">

        <thead>

            <tr>

                <th>ID</th>
                <th>Fecha</th>
                <th>Proveedor</th>
                <th>Factura</th>
                <th>Total</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody></tbody>

    </table>
<?php endif; ?>
<script>
    const PUEDE_CREAR_COMPRAS =
        <?= tienePermiso(
            'compras_crear'
        ) ? 'true' : 'false' ?>;
    const PUEDE_CAMBIAR_ESTADO_CLIENTES =
        <?= tienePermiso('clientes_eliminar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_EDITAR_CLIENTES =
        <?= tienePermiso('clientes_editar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/compras.js"></script>