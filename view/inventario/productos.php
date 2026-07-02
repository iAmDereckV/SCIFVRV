<h2>Productos</h2>
<?php if (
    tienePermiso('productos_crear')
    ||
    tienePermiso('productos_editar')
): ?>
<form id="formProducto">

    <input type="text" id="codigo" class="form-control mb-2" placeholder="Código">

    <input type="text" id="nombre" class="form-control mb-2" placeholder="Nombre">

    <textarea id="descripcion" class="form-control mb-2" placeholder="Descripción"></textarea>

    <textarea id="vehiculo_aplicable" class="form-control mb-2" placeholder="Vehículo aplicable"></textarea>

    <select id="categoria_id" class="form-control mb-2">
    </select>

    <select id="marca_id" class="form-control mb-2">
    </select>

    <input type="number" step="0.01" id="precio_compra" class="form-control mb-2" placeholder="Precio compra">

    <input type="number" step="0.01" id="precio_venta" class="form-control mb-2" placeholder="Precio venta">

    <input type="number" id="stock" class="form-control mb-2" placeholder="Stock">

    <input type="number" id="stock_minimo" class="form-control mb-2" placeholder="Stock mínimo">
    <label>Imagen</label>

    <input type="file" id="imagen" class="form-control" accept="image/*">
    <input type="text" id="ubicacion" class="form-control mb-2" placeholder="Ubicación">

    <button type="submit" class="btn btn-primary">
        Guardar
    </button>

</form>
<?php endif; ?>
<hr>

<table class="table table-bordered" id="tablaProductos">

    <thead>

        <tr>

            <th>Código</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
            <th>Precio Venta</th>
            <th>Stock</th>
            <th>Vehiculo Aplicable</th>
            <th>Descripción</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody></tbody>

</table>
<div class="modal fade" id="modalImagen">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Cambiar Imagen</h5>

            </div>

            <div class="modal-body">

                <input type="hidden" id="producto_imagen_id">

                <input type="file" id="nueva_imagen" class="form-control" accept="image/*">

            </div>

            <div class="modal-footer">

                <button class="btn btn-primary" onclick="guardarImagen()">

                    Guardar

                </button>

            </div>

        </div>

    </div>

</div>
<script>
const PUEDE_EDITAR_PRODUCTOS =
    <?= tienePermiso('productos_editar')
            ? 'true'
            : 'false' ?>;
const PUEDE_CREAR_PRODUCTOS =
    <?= tienePermiso(
            'productos_crear'
        ) ? 'true' : 'false' ?>;
const PUEDE_CAMBIAR_ESTADO_PRODUCTOS =
    <?= tienePermiso('productos_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/productos.js"></script>