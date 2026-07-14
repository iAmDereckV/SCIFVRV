document.addEventListener("DOMContentLoaded", () => {
  cargarCategorias();

  document
    .getElementById("formCategoria")
    .addEventListener("submit", guardarCategoria);
});

async function cargarCategorias() {
  if ($.fn.DataTable.isDataTable("#tablaCategorias")) {
    $("#tablaCategorias").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/categorias/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((categoria) => {
    let estado =
      categoria.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    html += `
      <tr>

        <td>${categoria.id}</td>

        <td>${categoria.nombre}</td>

        <td>${categoria.descripcion ?? ""}</td>

        <td>${estado}</td>

        <td>
<div class="btn-group">
          <button
          title="Editar"
            class="btn btn-sm btn-outline-primary"
            onclick="editarCategoria(${categoria.id})">

              <i class="bi bi-pencil"></i>

          </button>

          <button
          title="Estado"
           class="btn btn-sm btn-outline-danger"
            onclick="cambiarEstado(
                ${categoria.id},
                '${categoria.estado}'
            )">

            <i class="bi bi-arrow-repeat"></i>

          </button>
</div>
        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaCategorias tbody").innerHTML = html;
  $("#tablaCategorias").DataTable({
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

async function guardarCategoria(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("descripcion", document.getElementById("descripcion").value);

  let id = document.getElementById("formCategoria").dataset.id;

  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id
      ? IRL + "/api/categorias/actualizar.php"
      : IRL + "/api/categorias/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Categoría guardada");

    document.getElementById("formCategoria").reset();

    delete document.getElementById("formCategoria").dataset.id;
    bootstrap.Modal.getInstance(
      document.getElementById("modalCategoria"),
    ).hide();
    cargarCategorias();
  }
}

async function editarCategoria(id) {
  if (!PUEDE_EDITAR_CATEGORIAS) {
    alert("No tiene permiso para editar categorias");

    return;
  }
  let response = await fetch(IRL + "/api/categorias/obtener.php?id=" + id);

  let categoria = await response.json();

  document.getElementById("nombre").value = categoria.nombre;

  document.getElementById("descripcion").value = categoria.descripcion;

  document.getElementById("formCategoria").dataset.id = categoria.id;
  new bootstrap.Modal(document.getElementById("modalCategoria")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_CATEGORIAS) {
    alert(`No tiene permiso para poner categorias ${nuevoEstado}`);
    return;
  }

  let response = await fetch(IRL + "/api/categorias/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarCategorias();
  }
}

function nuevoCategoria() {
  if (!PUEDE_CREAR_CATEGORIAS) {
    alert("No tiene permiso para crear categorias");

    return;
  }
  document.getElementById("formCategoria").reset();

  delete document.getElementById("formCategoria").dataset.id;

  new bootstrap.Modal(document.getElementById("modalCategoria")).show();
}
