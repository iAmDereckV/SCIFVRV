document.addEventListener("DOMContentLoaded", () => {
  cargarCategorias();
  cargarMarcas();
  cargarProductos();
  document
    .getElementById("formProducto")
    .addEventListener("submit", guardarProducto);
});
async function cargarProductos() {
  if ($.fn.DataTable.isDataTable("#tablaProductos")) {
    $("#tablaProductos").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/productos/listar.php");
  let data = await response.json();
  let html = "";
  data.forEach((producto) => {
    let foto = producto.imagen
      ? `uploads/productos/${producto.imagen}`
      : `assets/img/sin-imagen.png`;
    let estado =
      producto.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    let stock =
      parseInt(producto.stock) <= parseInt(producto.stock_minimo)
        ? `<span class="badge bg-danger">${producto.stock}</span>`
        : `<span class="badge bg-success">${producto.stock}</span>`;
    html += `
      <tr>
        <td>${producto.codigo}</td>
<td>
<img
src="${foto}"
class="rounded-circle shadow-sm border"
style="
width:55px;
height:55px;
object-fit:cover;
">
</td>
        <td>${producto.nombre}</td>
        <td>C$ ${Number(producto.precio_compra).toFixed(2)}</td>
        <td>C$ ${Number(producto.precio_venta).toFixed(2)}</td>
              <td>${stock}</td>
        <td>${estado}</td>
        <td>
<div class="btn-group">
  <button
    class="btn btn-sm btn-outline-info"
    onclick="verProducto(${producto.id})"
    title="Ver detalles">
    <i class="bi bi-eye-fill"></i>
</button>
          <button
          title="Editar"
            class="btn btn-sm btn-outline-primary"
            onclick="editarProducto(${producto.id})" >
            <i class="bi bi-pencil-square"></i>
          </button>
          <button
          title="Estado"
           class="btn btn-sm ${
             producto.estado === "ACTIVO"
               ? "btn-outline-danger"
               : "btn-outline-success"
           }"
            onclick="cambiarEstado(
              ${producto.id},
              '${producto.estado}'
            )">
            <i class="bi bi-arrow-repeat"></i>
          </button>
        <button
   title="Foto"
            class="btn btn-sm btn-outline-warning"
    onclick="cambiarImagen(${producto.id})">

    <i class="bi bi-image"></i>
</button>
</div>
        </td>
      </tr>
    `;
  });
  document.querySelector("#tablaProductos tbody").innerHTML = html;
  $("#tablaProductos").DataTable({
    language: {
      processing: "Procesando...",
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_",
      infoEmpty: "Mostrando 0 registros",
      zeroRecords: "No se encontraron registros",
      emptyTable: "Sin datos",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    responsive: true,
    pageLength: 5,
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "Todos"],
    ],
    order: [[2, "asc"]],
  });
}

async function cargarCategorias() {
  let response = await fetch(IRL + "/api/productos/categorias.php");
  let data = await response.json();
  let html = '<option value="">Seleccione Categoría</option>';
  data.forEach((categoria) => {
    html += `
      <option value="${categoria.id}">
        ${categoria.nombre}
      </option>
    `;
  });
  document.getElementById("categoria_id").innerHTML = html;
}

async function cargarMarcas() {
  let response = await fetch(IRL + "/api/productos/marcas.php");
  let data = await response.json();
  let html = '<option value="">Seleccione Marca</option>';
  data.forEach((marca) => {
    html += `
      <option value="${marca.id}">
        ${marca.nombre}
      </option>
    `;
  });
  document.getElementById("marca_id").innerHTML = html;
}
async function verProducto(id) {
  let response = await fetch(IRL + "/api/productos/detalle.php?id=" + id);
  let producto = await response.json();
  document.getElementById("detalleCodigo").textContent = producto.codigo;
  document.getElementById("detalleNombre").textContent = producto.nombre;
  document.getElementById("detalleCategoria").textContent = producto.categoria;
  document.getElementById("detalleMarca").textContent = producto.marca;
  document.getElementById("detalleCosto").textContent =
    "C$ " + Number(producto.precio_compra).toFixed(2);
  document.getElementById("detalleVenta").textContent =
    "C$ " + Number(producto.precio_venta).toFixed(2);
  document.getElementById("detalleStock").textContent = producto.stock;
  document.getElementById("detalleStockMinimo").textContent =
    producto.stock_minimo;
  document.getElementById("detalleUbicacion").textContent =
    producto.ubicacion || "-";
  document.getElementById("detalleVehiculo").textContent =
    producto.vehiculo_aplicable || "-";
  document.getElementById("detalleEstado").innerHTML =
    producto.estado === "ACTIVO"
      ? '<span class="badge bg-success">ACTIVO</span>'
      : '<span class="badge bg-danger">INACTIVO</span>';
  document.getElementById("detalleDescripcion").textContent =
    producto.descripcion || "Sin descripción";
  document.getElementById("detalleImagen").src = producto.imagen
    ? "uploads/productos/" + producto.imagen
    : "assets/img/sin-imagen.png";
  new bootstrap.Modal(document.getElementById("modalDetalleProducto")).show();
}
function nuevoProducto() {
  if (!PUEDE_CREAR_PRODUCTOS) {
    alertaWarning("No tiene permiso para crear productos");
    return;
  }
  document.getElementById("formProducto").reset();
  delete document.getElementById("formProducto").dataset.id;
  new bootstrap.Modal(document.getElementById("modalProducto")).show();
}
async function guardarProducto(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append("codigo", document.getElementById("codigo").value);
  formData.append(
    "categoria_id",
    document.getElementById("categoria_id").value,
  );
  formData.append("marca_id", document.getElementById("marca_id").value);
  formData.append("nombre", document.getElementById("nombre").value);
  formData.append("descripcion", document.getElementById("descripcion").value);
  formData.append(
    "vehiculo_aplicable",
    document.getElementById("vehiculo_aplicable").value,
  );
  formData.append(
    "precio_compra",
    document.getElementById("precio_compra").value,
  );
  formData.append(
    "precio_venta",
    document.getElementById("precio_venta").value,
  );
  let imagen = document.getElementById("imagen").files[0];
  if (imagen) {
    formData.append("imagen", imagen);
  }
  formData.append("stock", document.getElementById("stock").value);
  formData.append(
    "stock_minimo",
    document.getElementById("stock_minimo").value,
  );
  formData.append("ubicacion", document.getElementById("ubicacion").value);
  let id = document.getElementById("formProducto").dataset.id;
  if (id) {
    formData.append("id", id);
  }
  let response = await fetch(
    id
      ? IRL + "/api/productos/actualizar.php"
      : IRL + "/api/productos/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );
  let data = await response.json();
  if (data.success) {
    alertaSuccess("Producto guardado");
    document.getElementById("formProducto").reset();
    delete document.getElementById("formProducto").dataset.id;
    bootstrap.Modal.getInstance(
      document.getElementById("modalProducto"),
    ).hide();
    cargarProductos();
  } else {
    alertaError("Error al guardar producto");
  }
}
async function guardarImagen() {
  let id = document.getElementById("producto_imagen_id").value;
  let archivo = document.getElementById("nueva_imagen").files[0];
  if (!archivo) {
    alertaError("Seleccione una imagen");
    return;
  }
  let formData = new FormData();
  formData.append("id", id);
  formData.append("imagen", archivo);
  let response = await fetch(IRL + "/api/productos/cambiar_imagen.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    alertaSuccess("Imagen actualizada");
    bootstrap.Modal.getInstance(document.getElementById("modalImagen")).hide();
    cargarProductos();
  } else {
    alertaError("Error");
  }
  document.getElementById("nueva_imagen").value = "";
}
async function editarProducto(id) {
  if (!PUEDE_EDITAR_PRODUCTOS) {
    alertaWarning("No tiene permiso para editar productos");
    return;
  }
  let response = await fetch(IRL + "/api/productos/obtener.php?id=" + id);
  let producto = await response.json();
  document.getElementById("codigo").value = producto.codigo;
  document.getElementById("categoria_id").value = producto.categoria_id;
  document.getElementById("marca_id").value = producto.marca_id;
  document.getElementById("nombre").value = producto.nombre;
  document.getElementById("descripcion").value = producto.descripcion;
  document.getElementById("vehiculo_aplicable").value =
    producto.vehiculo_aplicable;
  document.getElementById("precio_compra").value = producto.precio_compra;
  document.getElementById("precio_venta").value = producto.precio_venta;
  document.getElementById("stock").value = producto.stock;
  document.getElementById("stock_minimo").value = producto.stock_minimo;
  document.getElementById("ubicacion").value = producto.ubicacion;
  document.getElementById("formProducto").dataset.id = producto.id;
  new bootstrap.Modal(document.getElementById("modalProducto")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";
  if (!PUEDE_CAMBIAR_ESTADO_PRODUCTOS) {
    alertaWarning(`No tiene permiso para poner productos ${nuevoEstado}`);
    return;
  }
  let formData = new FormData();
  formData.append("id", id);
  formData.append("estado", nuevoEstado);
  let response = await fetch(IRL + "/api/productos/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    cargarProductos();
  } else {
    alertaError(`Error al poner producto ${nuevoEstado}`);
  }
}
function cambiarImagen(id) {
  if (!PUEDE_EDITAR_PRODUCTOS) {
    alertaWarning("No tiene permiso para cambiar imagen");
    return;
  }
  document.getElementById("producto_imagen_id").value = id;
  let modal = new bootstrap.Modal(document.getElementById("modalImagen"));
  modal.show();
}
