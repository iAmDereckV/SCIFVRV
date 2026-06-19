document.addEventListener("DOMContentLoaded", () => {
  cargarProductos();
  cargarCategorias();
  cargarMarcas();

  document
    .getElementById("formProducto")
    .addEventListener("submit", guardarProducto);
});

async function cargarProductos() {
  let response = await fetch(IRL + "/api/productos/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((producto) => {
    let foto = producto.imagen
      ? `uploads/productos/${producto.imagen}`
      : `assets/img/sin-imagen.png`;
    html += `
      <tr>

        <td>${producto.codigo}</td>
<td>

<img
    src="${foto}"
    width="60"
    height="60"
    style="object-fit:cover;">

</td>
        <td>${producto.nombre}</td>

        <td>${producto.categoria}</td>

        <td>${producto.marca}</td>

        <td>${producto.precio_venta}</td>

        <td>${producto.stock}</td>
        <td>${producto.vehiculo_aplicable}</td>
        <td>${producto.descripcion}</td>
        <td>${producto.ubicacion}</td>

        <td>${producto.estado}</td>

        <td>

          <button
            class="btn btn-warning btn-sm"
            onclick="editarProducto(${producto.id})">

            Editar

          </button>

          <button
            class="btn btn-danger btn-sm"
            onclick="cambiarEstado(
              ${producto.id},
              '${producto.estado}'
            )">

            Estado

          </button>
<button
    class="btn btn-warning btn-sm"
    onclick="cambiarImagen(${producto.id})">

    Foto

</button>
        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaProductos tbody").innerHTML = html;
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
  if (!id && !PUEDE_CREAR_PRODUCTOS) {
    alert("No tiene permiso para crear productos");

    return;
  }

  if (id && !PUEDE_EDITAR_PRODUCTOS) {
    alert("No tiene permiso para editar productos");

    return;
  }
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

    cargarProductos();
  }
}

async function editarProducto(id) {
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
