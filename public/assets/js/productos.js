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
      producto.stock <= producto.stock_minimo
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

        <td>${producto.categoria}</td>

        <td>${producto.marca}</td>

        <td>C$ ${Number(producto.precio_venta).toFixed(2)}</td>

        <td>${stock}</td>
        <td>${producto.vehiculo_aplicable}</td>
        <td>${producto.descripcion}</td>
        <td>${producto.ubicacion}</td>

        <td>${estado}</td>

        <td>
<div class="btn-group">
          <button
          title="Editar"
            class="btn btn-sm btn-outline-primary"
            onclick="editarProducto(${producto.id})" >

            <i class="bi bi-pencil"></i>

          </button>

          <button
          title="Estado"
            class="btn btn-sm btn-outline-danger"
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

    pageLength: 10,

    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "Todos"],
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
    alert("Producto guardado");

    document.getElementById("formProducto").reset();

    delete document.getElementById("formProducto").dataset.id;
    bootstrap.Modal.getInstance(
      document.getElementById("modalProducto"),
    ).hide();
    cargarProductos();
  }
}

async function editarProducto(id) {
  if (!PUEDE_EDITAR_PRODUCTOS) {
    alert("No tiene permiso para editar productos");

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

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_PRODUCTOS) {
    alert(`No tiene permiso para poner productos ${nuevoEstado}`);

    return;
  }
  let response = await fetch(IRL + "/api/productos/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarProductos();
  }
}
function cambiarImagen(id) {
  if (!PUEDE_CAMBIAR_ESTADO_PRODUCTOS) {
    alert("No tiene permiso para imagen");
    return;
  }
  document.getElementById("producto_imagen_id").value = id;

  let modal = new bootstrap.Modal(document.getElementById("modalImagen"));

  modal.show();
}
async function guardarImagen() {
  let id = document.getElementById("producto_imagen_id").value;

  let archivo = document.getElementById("nueva_imagen").files[0];

  if (!archivo) {
    alert("Seleccione una imagen");

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
    alert("Imagen actualizada");

    location.reload();
  } else {
    alert("Error");
  }
}
function nuevoProducto() {
  if (!PUEDE_CREAR_PRODUCTOS) {
    alert("No tiene permiso para crear productos");
    return;
  }
  document.getElementById("formProducto").reset();

  delete document.getElementById("formProducto").dataset.id;

  new bootstrap.Modal(document.getElementById("modalProducto")).show();
}
