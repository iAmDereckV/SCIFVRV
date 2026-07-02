<h2>Kardex de Inventario</h2>

<div class="row">

    <div class="col-md-6">

        <label>Producto</label>

        <select id="producto_id" class="form-control">
        </select>

    </div>

    <div class="col-md-2">

        <label>&nbsp;</label>

        <button class="btn btn-primary form-control" onclick="consultarKardex()">

            Consultar

        </button>

    </div>

</div>
<div id="infoProducto" class="row mb-3" style="display:none;">

    <div class="col-md-2">

        <img id="fotoProducto" src="" class="img-thumbnail" style="
                width:120px;
                height:120px;
                object-fit:cover;
            ">

    </div>

    <div class="col-md-10">

        <h4 id="nombreProducto"></h4>

        <p>

            Código:
            <strong id="codigoProducto"></strong>

        </p>

        <p>

            Stock Actual:
            <strong id="stockProducto"></strong>

        </p>

    </div>

</div>
<hr>

<table class="table" id="tablaKardex">

    <thead>

        <tr>

            <th>Fecha</th>

            <th>Tipo</th>

            <th>Cantidad</th>

            <th>Detalle</th>
            <th>Saldo</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>

<script src="assets/js/kardex.js"></script>