document.addEventListener("DOMContentLoaded", () => {
  cargarProveedores();

  document
    .getElementById("formProveedor")
    .addEventListener("submit", guardarProveedor);
});

async function cargarProveedores() {
  if ($.fn.DataTable.isDataTable("#tablaProveedores")) {
    $("#tablaProveedores").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/proveedores/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((proveedor) => {
    let estado =
      proveedor.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    html += `
      <tr>

        <td>${proveedor.id}</td>

        <td>${proveedor.nombre}</td>

        <td>${proveedor.contacto ?? ""}</td>

        <td>${proveedor.telefono ?? ""}</td>

        <td>${estado}</td>

        <td>
<div class="btn-group">
          <button
            title="Editar"
            class="btn btn-sm btn-outline-primary"
            onclick="editarProveedor(${proveedor.id})">

            <i class="bi bi-pencil-square"></i>

          </button>

          <button
            title="Estado"
            class="btn btn-sm ${
              proveedor.estado === "ACTIVO"
                ? "btn-outline-danger"
                : "btn-outline-success"
            }"
            onclick="
              cambiarEstado(
                ${proveedor.id},
                '${proveedor.estado}'
              )">

            <i class="bi bi-arrow-repeat"></i>

          </button>
</div>
        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaProveedores tbody").innerHTML = html;
  $("#tablaProveedores").DataTable({
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

async function guardarProveedor(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("contacto", document.getElementById("contacto").value);

  formData.append("telefono", document.getElementById("telefono").value);

  formData.append("correo", document.getElementById("correo").value);

  formData.append("direccion", document.getElementById("direccion").value);

  let id = document.getElementById("formProveedor").dataset.id;

  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id
      ? IRL + "/api/proveedores/actualizar.php"
      : IRL + "/api/proveedores/guardar.php",

    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Proveedor guardado");

    document.getElementById("formProveedor").reset();

    delete document.getElementById("formProveedor").dataset.id;
    bootstrap.Modal.getInstance(
      document.getElementById("modalProveedor"),
    ).hide();
    cargarProveedores();
  } else {
    alert("Error al guardar");
  }
}

async function editarProveedor(id) {
  if (!PUEDE_EDITAR_PROVEEDORES) {
    alert("No tiene permiso para editar proveedores");

    return;
  }
  let response = await fetch(IRL + "/api/proveedores/obtener.php?id=" + id);

  let proveedor = await response.json();

  document.getElementById("nombre").value = proveedor.nombre;

  document.getElementById("contacto").value = proveedor.contacto;

  document.getElementById("telefono").value = proveedor.telefono;

  document.getElementById("correo").value = proveedor.correo;

  document.getElementById("direccion").value = proveedor.direccion;

  document.getElementById("formProveedor").dataset.id = proveedor.id;
  new bootstrap.Modal(document.getElementById("modalProveedor")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";
  if (!PUEDE_CAMBIAR_ESTADO_PROVEEDORES) {
    alert(`No tiene permiso para poner proveedores ${nuevoEstado}`);

    return;
  }

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);

  let response = await fetch(IRL + "/api/proveedores/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarProveedores();
  }
}
function nuevoProveedor() {
  if (!PUEDE_CREAR_PROVEEDORES) {
    alert("No tiene permiso para crear proveedores");
    return;
  }
  document.getElementById("formProveedor").reset();

  delete document.getElementById("formProveedor").dataset.id;

  new bootstrap.Modal(document.getElementById("modalProveedor")).show();
}
