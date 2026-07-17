<div class="d-flex justify-content-between align-items-center mb-3">

    <h2 class="page-title mb-0">
        Productos
    </h2>

    <button class="btn btn-primary" onclick="nuevoProducto()">

        <i class="bi bi-plus-circle"></i>
        Nuevo Producto

    </button>

</div>

<div class="modal fade" id="modalProducto" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">

        <div class="modal-content">

            <form id="formProducto">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-box-seam text-white"></i>

                        Producto

                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row g-3">


                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-upc-scan"></i>
                                Código
                            </label>

                            <input type="text" id="codigo" required class="form-control" placeholder="Código del producto">
                        </div>

                        <div class="col-md-8">
                            <label class="form-label">
                                <i class="bi bi-box-seam-fill"></i>
                                Nombre
                            </label>

                            <input type="text" id="nombre" required class="form-control" placeholder="Nombre del producto">
                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="bi bi-tags-fill"></i>
                                Categoría
                            </label>

                            <select id="categoria_id" required class="form-select">
                            </select>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">
                                <i class="bi bi-bookmark-star-fill"></i>
                                Marca
                            </label>

                            <select id="marca_id" required class="form-select">
                            </select>

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">
                                <i class="bi bi-cash-coin"></i>Precio Compra
                            </label>

                            <input type="number" required step="0.01" id="precio_compra" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label"> <i class="bi bi-currency-dollar"></i>
                                Precio Venta
                            </label>

                            <input type="number" required step="0.01" id="precio_venta" class="form-control">

                        </div>

                        <div class="col-md-4">

                            <label class="form-label"><i class="bi bi-geo-alt-fill"></i>
                                Ubicación
                            </label>

                            <input type="text" id="ubicacion" class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label"><i class="bi bi-boxes"></i>
                                Stock
                            </label>

                            <input type="number" id="stock" class="form-control">

                        </div>

                        <div class="col-md-6">

                            <label class="form-label"><i class="bi bi-exclamation-triangle-fill"></i>
                                Stock mínimo
                            </label>

                            <input type="number" id="stock_minimo" required class="form-control">

                        </div>

                        <div class="col-md-12">

                            <label class="form-label"><i class="bi bi-car-front-fill"></i>
                                Vehículo aplicable
                            </label>

                            <textarea id="vehiculo_aplicable" class="form-control" rows="2"></textarea>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label"><i class="bi bi-card-text"></i>
                                Descripción
                            </label>

                            <textarea id="descripcion" class="form-control" rows="3"></textarea>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label"><i class="bi bi-image-fill"></i>
                                Imagen
                            </label>

                            <input type="file" id="imagen" class="form-control" accept="image/*">

                        </div>

                    </div>


                </div>

                <div class="modal-footer">

                    <button type="reset" class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-clockwise"></i>

                        Limpiar

                    </button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                        <i class="bi bi-x-circle"></i>

                        Cancelar

                    </button>

                    <button type="submit" class="btn btn-primary">

                        <i class="bi bi-check-circle"></i>

                        Guardar Producto

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<hr>
<div class="table-responsive">
    <table class="table table-hover" id="tablaProductos">

        <thead>
            <tr>

                <th>Código</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Precio Costo</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Estado</th>
                <th>Acciones</th>

            </tr>

        </thead>

        <tbody></tbody>

    </table>
</div>
<div class=" modal fade" id="modalImagen">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Cambiar Imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>

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