document.addEventListener("DOMContentLoaded", () => {
  cargarCategorias();
  cargarGastos();
  document
    .getElementById("formCategoria")
    .addEventListener("submit", guardarCategoria);
  document.getElementById("formGasto").addEventListener("submit", guardarGasto);
});
async function cargarGastos() {
  if ($.fn.DataTable.isDataTable("#tablaGastos")) {
    $("#tablaGastos").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/gastos/listar.php");
  let data = await response.json();
  let html = "";
  data.forEach((gasto) => {
    html += `
        <tr>
            <td>${gasto.fecha}</td>
            <td>${gasto.categoria}</td>
            <td>${gasto.descripcion}</td>
            <td>C$ ${gasto.monto}</td>
            <td>${gasto.usuario}</td> 
        <td>
    ${
      gasto.archivo_factura
        ? `<a
            href="${IRL}/public/uploads/gastos/${gasto.archivo_factura}"
            target="_blank"
            class="btn btn-info btn-sm">
            Ver
         </a>`
        : "-"
    }
</td>
            <td>
<div class="btn-group">
<button
    title="Editar"
    class="btn btn-sm btn-outline-primary"
    onclick="editarGasto(${gasto.id})">
    <i class="bi bi-pencil-square"></i>
</button>
<button
    title="Foto"
            class="btn btn-sm btn-outline-warning"
    onclick="cambiarComprobante(${gasto.id})">
    <i class="bi bi-image"></i>
</button>
</div>
</td>
        </tr>
        `;
  });
  document.querySelector("#tablaGastos tbody").innerHTML = html;
  $("#tablaGastos").DataTable({
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
  let response = await fetch(IRL + "/api/gastos/categorias.php");
  let data = await response.json();
  let html = '<option value="">Seleccione</option>';
  data.forEach((categoria) => {
    html += `
            <option value="${categoria.id}">
                ${categoria.nombre}
            </option>
        `;
  });
  document.getElementById("categoria_id").innerHTML = html;
}
function nuevoGasto() {
  if (!PUEDE_CREAR_GASTOS) {
    alert("No tiene permiso para crear gastos");
    return;
  }
  document.getElementById("formGasto").reset();
  delete document.getElementById("formGasto").dataset.id;
  new bootstrap.Modal(document.getElementById("modalGasto")).show();
}
function nuevaCategoria() {
  if (!PUEDE_CREAR_GASTOS) {
    alert("No tiene permiso para crear categoría de gasto");
    return;
  }
  document.getElementById("formCategoria").reset();
  delete document.getElementById("formCategoria").dataset.id;
  new bootstrap.Modal(document.getElementById("modalCategoriaGasto")).show();
}
async function guardarGasto(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append(
    "categoria_id",
    document.getElementById("categoria_id").value,
  );
  formData.append("descripcion", document.getElementById("descripcion").value);
  formData.append("monto", document.getElementById("monto").value);
  formData.append("fecha", document.getElementById("fecha").value);
  let id = document.getElementById("formGasto").dataset.id;
  if (id) {
    formData.append("id", id);
  }
  let archivo = document.getElementById("archivo_factura").files[0];
  if (archivo) {
    formData.append("archivo_factura", archivo);
  }
  let response = await fetch(
    id ? IRL + "/api/gastos/actualizar.php" : IRL + "/api/gastos/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );
  let data = await response.json();
  if (data.success) {
    document.getElementById("formGasto").reset();
    delete document.getElementById("formGasto").dataset.id;
    bootstrap.Modal.getInstance(document.getElementById("modalGasto")).hide();
    cargarGastos();
  } else {
    alert("Error al guardar gasto");
  }
}
async function guardarCategoria(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append("nombre", document.getElementById("nombreCategoria").value);
  let id = document.getElementById("formCategoria").dataset.id;
  if (id) {
    formData.append("id", id);
  }
  let response = await fetch(
    id
      ? IRL + "/api/gastos/categoria_actualizar.php"
      : IRL + "/api/gastos/categoria_guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );
  let data = await response.json();
  if (data.success) {
    bootstrap.Modal.getInstance(
      document.getElementById("modalCategoriaGasto"),
    ).hide();
    await cargarCategorias();
  } else {
    alert("Error al guardar categoría gasto");
  }
}
async function guardarImagen() {
  let id = document.getElementById("gasto_imagen_id").value;
  let archivo = document.getElementById("nueva_imagen").files[0];
  if (!archivo) {
    alert("Seleccione una imagen");
    return;
  }
  let formData = new FormData();
  formData.append("id", id);
  formData.append("imagen", archivo);
  let response = await fetch(IRL + "/api/gastos/cambiar_comprobante.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    alert("Imagen actualizada");
    bootstrap.Modal.getInstance(document.getElementById("modalImagen")).hide();
    cargarGastos();
  } else {
    alert("Error");
  }
  document.getElementById("nueva_imagen").value = "";
}
async function editarGasto(id) {
  if (!PUEDE_EDITAR_GASTOS) {
    alert("No tiene permiso para editar gastos");
    return;
  }
  let response = await fetch("/SCIFVRV/api/gastos/obtener.php?id=" + id);
  let gasto = await response.json();
  document.getElementById("categoria_id").value = gasto.categoria_id;
  document.getElementById("descripcion").value = gasto.descripcion;
  document.getElementById("monto").value = gasto.monto;
  document.getElementById("fecha").value = gasto.fecha;
  document.getElementById("formGasto").dataset.id = gasto.id;
  new bootstrap.Modal(document.getElementById("modalGasto")).show();
}

async function editarCategoria() {
  if (!PUEDE_EDITAR_GASTOS) {
    alert("No tiene permiso para editar categoria gasto");
    return;
  }
  let id = document.getElementById("categoria_id").value;
  if (!id) {
    alert("Seleccione una categoría");
    return;
  }
  let response = await fetch(
    IRL + "/api/gastos/categoria_obtener.php?id=" + id,
  );
  let categoria = await response.json();
  document.getElementById("nombreCategoria").value = categoria.nombre;
  document.getElementById("formCategoria").dataset.id = categoria.id;
  new bootstrap.Modal(document.getElementById("modalCategoriaGasto")).show();
}
function cambiarComprobante(id) {
  if (!PUEDE_EDITAR_GASTOS) {
    alert("No tiene permiso para cambiar imagen");
    return;
  }
  document.getElementById("gasto_imagen_id").value = id;
  let modal = new bootstrap.Modal(document.getElementById("modalImagen"));
  modal.show();
}
