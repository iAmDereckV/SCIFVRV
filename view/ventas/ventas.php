<h2>Nueva Venta</h2>

<div class="row">

    <div class="col-md-4">

        <label>Cliente</label>

        <select id="cliente_id" class="form-control">

        </select>

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

        <input type="number" id="cantidad" value="1" min="1" class="form-control">

    </div>

    <div class="col-md-2">

        <button class="btn btn-success mt-4" onclick="agregarProducto()">

            Agregar

        </button>

    </div>

</div>

<hr>

<table class="table table-bordered" id="tablaDetalle">

    <thead>

        <tr>

            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>

        </tr>

    </thead>

    <tbody></tbody>

</table>

<div class="row">

    <div class="col-md-3">

        <label>Subtotal</label>

        <input type="text" id="subtotal" class="form-control" readonly>

    </div>
    <div class="col-md-3">

        <label>Tipo Descuento</label>

        <select id="tipo_descuento" class="form-control">

            <option value="porcentaje">
                %
            </option>

            <option value="monto">
                C$
            </option>

        </select>

        <label>Descuento</label>

        <input type="number" id="descuento_valor" value="0" class="form-control">
        <label>Descuento Aplicado</label>

        <input type="text" id="descuento" readonly class="form-control">

    </div>

    <div class="col-md-3">

        <label>Impuesto (%)</label>

        <input type="number" id="porcentaje_impuesto" value="15" min="0" step="0.01" class="form-control">

    </div>
    <div class="col-md-3">

        <label>Impuesto</label>

        <input type="text" id="impuesto" class="form-control" readonly>

    </div>
    <div class="col-md-3">

        <label>Total</label>

        <input type="text" id="total" class="form-control" readonly>

    </div>

</div>

<hr>

<button class="btn btn-primary" onclick="guardarVenta()">

    Finalizar Venta

</button>

<script src="assets/js/ventas.js"></script>