<h2 class="fw-bold mb-2">Kardex de Inventario</h2>

<div class="row">

    <div class="col-md-4">

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

<div id="infoProducto" class="card shadow-sm border-0 mb-4 mt-4" style="display:none;">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-2 text-center">

                <img id="fotoProducto" src="" class="img-fluid rounded shadow-sm producto-card-img">

            </div>

            <div class="col-md-10">

                <h4 id="nombreProducto" class="fw-bold text-primary mb-3"></h4>

                <div class="row">

                    <div class="col-md-4">

                        <small class="text-muted">
                            Código
                        </small>

                        <h6 id="codigoProducto" class="fw-bold"></h6>

                    </div>

                    <div class="col-md-4">

                        <small class="text-muted">
                            Stock Actual
                        </small>

                        <h6 id="stockProducto" class="fw-bold text-success"></h6>

                    </div>

                    <div class="col-md-4">

                        <small class="text-muted">
                            Estado
                        </small>

                        <h6 id="estadoProducto"></h6>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<hr>
<div class="table-responsive">
    <table class="table table-hover table-sm align-middle" id="tablaKardex">

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
</div>

<script src="assets/js/kardex.js"></script>