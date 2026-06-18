document.addEventListener("DOMContentLoaded", () => {
  cargarRoles();
});

async function cargarRoles() {
  let response = await fetch(IRL + "/api/roles/listar.php");

  let data = await response.json();

  let html = "";
  data.forEach((rol) => {
    html += `
<tr>
    <td>${rol.id}</td>
    <td>${rol.nombre}</td>
    <td>${rol.descripcion}</td>
    <td>${rol.estado}</td>

    <td>

        <button
            class="btn btn-warning btn-sm"
            onclick="editarPermisos(${rol.id})">

            Permisos

        </button>
        <button
            class="btn btn-danger btn-sm"
            onclick="
            cambiarEstado(
                ${rol.id},
                '${rol.estado}'
            )">

            Estado

        </button>

    </td>

</tr>
`;
  });

  document.querySelector("#tablaRoles tbody").innerHTML = html;
}
let rolSeleccionado = null;

async function editarPermisos(id) {
  rolSeleccionado = id;

  let response = await fetch(IRL + "/api/roles/permisos.php?id=" + id);

  let permisos = await response.json();

  let html = "";

  permisos.forEach((permiso) => {
    html += `
        <div class="form-check">

            <input
                class="form-check-input permiso"
                type="checkbox"
                value="${permiso.id}"

                ${permiso.asignado == 1 ? "checked" : ""}

            <label class="form-check-label">

                ${permiso.codigo}

            </label>

        </div>
        `;
  });

  document.getElementById("listaPermisos").innerHTML = html;

  new bootstrap.Modal(document.getElementById("modalPermisos")).show();
}
async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

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
    alert("Permisos guardados");

    bootstrap.Modal.getInstance(
      document.getElementById("modalPermisos"),
    ).hide();
  }
}
