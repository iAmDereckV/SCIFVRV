document.addEventListener("DOMContentLoaded", () => {
  cargarRoles();
  document.getElementById("formRol").addEventListener("submit", guardarRol);
});
let rolSeleccionado = null;
async function cargarRoles() {
  if ($.fn.DataTable.isDataTable("#tablaRoles")) {
    $("#tablaRoles").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/roles/listar.php");
  let data = await response.json();
  let html = "";
  data.forEach((rol) => {
    let estado =
      rol.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    html += `
<tr>
    <td>${rol.id}</td>
    <td>${rol.nombre}</td>
    <td>${rol.descripcion}</td>
    <td>${estado}</td>
    <td>
<div class="btn-group">
                <button
            class="btn btn-sm btn-outline-warning"
            onclick="editarPermisos(${rol.id})">
            <i class="bi bi-shield-lock"></i>
        </button>
        <button
            class="btn btn-sm btn-outline-primary"
            onclick="editarRol(${rol.id})">
              <i class="bi bi-pencil-square"></i>
        </button>
        <button
            class="btn btn-sm ${
              rol.estado === "ACTIVO"
                ? "btn-outline-danger"
                : "btn-outline-success"
            }"
            onclick="
            cambiarEstado(
                ${rol.id},
                '${rol.estado}'
            )">
            <i class="bi bi-arrow-repeat"></i>
        </button>
</div>
    </td>
</tr>
`;
  });
  document.querySelector("#tablaRoles tbody").innerHTML = html;
  $("#tablaRoles").DataTable({
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
      [5, 10, -1],
      [5, 10, "Todos"],
    ],
    order: [[2, "asc"]],
  });
}
function seleccionarTodos() {
  document.querySelectorAll(".permiso").forEach((check) => {
    check.checked = true;
  });
}
function quitarTodos() {
  document.querySelectorAll(".permiso").forEach((check) => {
    if (check.dataset.dashboard == "1") {
      check.checked = true;
    } else {
      check.checked = false;
    }
  });
}
function nuevoRol() {
  if (!PUEDE_CREAR_ROLES) {
    alertaWarning("No tiene permiso para crear roles");
    return;
  }
  document.getElementById("formRol").reset();
  delete document.getElementById("formRol").dataset.id;
  new bootstrap.Modal(document.getElementById("modalRol")).show();
}
async function guardarRol(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append("nombre", document.getElementById("nombre").value);
  formData.append("descripcion", document.getElementById("descripcion").value);
  let id = document.getElementById("formRol").dataset.id;
  if (id) {
    formData.append("id", id);
  }
  let response = await fetch(
    id ? IRL + "/api/roles/actualizar.php" : IRL + "/api/roles/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );
  let data = await response.json();
  if (data.success) {
    alertaSuccess("Rol guardada");

    document.getElementById("formRol").reset();

    delete document.getElementById("formRol").dataset.id;
    bootstrap.Modal.getInstance(document.getElementById("modalRol")).hide();
    cargarRoles();
  } else {
    alertaError("Error al guardar rol");
  }
}
async function guardarPermisos() {
  let permisos = [];
  document.querySelectorAll(".permiso:checked").forEach((checkbox) => {
    permisos.push(checkbox.value);
  });
  let formData = new FormData();
  formData.append("rol_id", rolSeleccionado);
  permisos.forEach((permiso) => {
    formData.append("permisos[]", permiso);
  });
  let response = await fetch(IRL + "/api/roles/guardar_permisos.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    alertaSuccess("Permisos guardados");

    bootstrap.Modal.getInstance(
      document.getElementById("modalPermisos"),
    ).hide();
  } else {
    alertaError("Error al guardar permisos");
  }
}
async function editarRol(id) {
  if (!PUEDE_EDITAR_ROLES) {
    alertaWarning("No tiene permiso para editar rol");
    return;
  }
  let response = await fetch(IRL + "/api/roles/obtener.php?id=" + id);
  let marca = await response.json();
  document.getElementById("nombre").value = marca.nombre;
  document.getElementById("descripcion").value = marca.descripcion;
  document.getElementById("formRol").dataset.id = marca.id;
  new bootstrap.Modal(document.getElementById("modalRol")).show();
}
async function editarPermisos(id) {
  if (!PUEDE_EDITAR_ROLES) {
    alertaWarning("No tiene permiso para editar permisos");
    return;
  }
  rolSeleccionado = id;
  let response = await fetch(IRL + "/api/roles/permisos.php?id=" + id);
  let permisos = await response.json();
  let html = "";
  permisos.forEach((permiso) => {
    console.log(permiso);
    html += `
        <div class="form-check">
            <input
                class="form-check-input permiso"
                type="checkbox"
                value="${permiso.id}"
                data-dashboard="${permiso.codigo === "dashboard_ver" ? 1 : 0}"
                ${permiso.asignado == 1 ? "checked" : ""}
            <label class="form-check-label">
                ${permiso.descripcion}
            </label>
        </div>
        `;
  });
  document.getElementById("listaPermisos").innerHTML = html;
  new bootstrap.Modal(document.getElementById("modalPermisos")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";
  if (!PUEDE_CAMBIAR_ESTADO_ROLES) {
    alertaWarning(`No tiene permiso para poner roles ${nuevoEstado}`);
    return;
  }
  let formData = new FormData();
  formData.append("id", id);
  formData.append("estado", nuevoEstado);
  let response = await fetch(IRL + "/api/roles/cambiar_estados.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    cargarRoles();
  } else {
    alertaError(`Error al poner rol ${nuevoEstado}`);
  }
}
