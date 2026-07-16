document.addEventListener("DOMContentLoaded", () => {
  cargarMarcas();

  document.getElementById("formMarca").addEventListener("submit", guardarMarca);
});

async function cargarMarcas() {
  if ($.fn.DataTable.isDataTable("#tablaMarcas")) {
    $("#tablaMarcas").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/marcas/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((marca) => {
    let estado =
      marca.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    html += `
      <tr>

        <td>${marca.id}</td>

        <td>${marca.nombre}</td>

        <td>${marca.descripcion ?? ""}</td>

        <td>${estado}</td>

        <td>
<div class="btn-group">
<button
          title="Editar"
            class="btn btn-sm btn-outline-primary"
            onclick="editarMarca(${marca.id})" >

            <i class="bi bi-pencil-square"></i>

          </button>
          <button
          title="Estado"
            class="btn btn-sm ${
              marca.estado === "ACTIVO"
                ? "btn-outline-danger"
                : "btn-outline-success"
            }"
            onclick="cambiarEstado(
              ${marca.id},
              '${marca.estado}'
            )">

            <i class="bi bi-arrow-repeat"></i>

          </button>
</div>
        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaMarcas tbody").innerHTML = html;
  $("#tablaMarcas").DataTable({
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
      [5, 10, 25, -1],
      [5, 10, 25, "Todos"],
    ],

    order: [[2, "asc"]],
  });
}

async function guardarMarca(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("descripcion", document.getElementById("descripcion").value);

  let id = document.getElementById("formMarca").dataset.id;
  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id ? IRL + "/api/marcas/actualizar.php" : IRL + "/api/marcas/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Marca guardada");

    document.getElementById("formMarca").reset();

    delete document.getElementById("formMarca").dataset.id;
    bootstrap.Modal.getInstance(document.getElementById("modalMarca")).hide();
    cargarMarcas();
  }
}

async function editarMarca(id) {
  if (!PUEDE_EDITAR_MARCAS) {
    alert("No tiene permiso para editar marcas");

    return;
  }
  let response = await fetch(IRL + "/api/marcas/obtener.php?id=" + id);

  let marca = await response.json();

  document.getElementById("nombre").value = marca.nombre;

  document.getElementById("descripcion").value = marca.descripcion;

  document.getElementById("formMarca").dataset.id = marca.id;
  new bootstrap.Modal(document.getElementById("modalMarca")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_MARCAS) {
    alert(`No tiene permiso para poner marcas ${nuevoEstado}`);

    return;
  }
  let response = await fetch(IRL + "/api/marcas/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarMarcas();
  }
}
function nuevaMarca() {
  if (!PUEDE_CREAR_MARCAS) {
    alert("No tiene permiso para crear marcas");
    return;
  }
  document.getElementById("formMarca").reset();

  delete document.getElementById("formMarca").dataset.id;

  new bootstrap.Modal(document.getElementById("modalMarca")).show();
}
