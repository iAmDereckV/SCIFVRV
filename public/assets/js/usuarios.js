document.addEventListener("DOMContentLoaded", () => {
  cargarUsuarios();
  cargarRoles();

  document
    .getElementById("formUsuario")
    .addEventListener("submit", guardarUsuario);
});

async function cargarUsuarios() {
  if ($.fn.DataTable.isDataTable("#tablaUsuarios")) {
    $("#tablaUsuarios").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/usuarios/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((usuario) => {
    let estado =
      usuario.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    let foto = usuario.foto
      ? `uploads/usuarios/${usuario.foto}`
      : `assets/img/sin-imagen.png`;

    html += `
<tr>

    <td>${usuario.id}</td>
    <td>
<img
    src="${foto}"
    class="rounded-circle shadow-sm border"
    style="
width:55px;
height:55px;
object-fit:cover;">

</td>
    <td>${usuario.nombre}</td>

    <td>${usuario.usuario}</td>

    <td>${usuario.rol}</td>

    <td>${estado}</td>
   
    <td>
<div class="btn-group">
<button
    class="btn btn-sm btn-outline-primary"
    onclick="editarUsuario(${usuario.id})">

    <i class="bi bi-pencil-square"></i>

</button>

        <button
            class="btn btn-sm ${
              usuario.estado === "ACTIVO"
                ? "btn-outline-danger"
                : "btn-outline-success"
            }"
            onclick="
            cambiarEstado(
                ${usuario.id},
                '${usuario.estado}'
            )">

            <i class="bi bi-arrow-repeat"></i>

        </button>
<button
    class="btn btn-sm btn-outline-warning"
    onclick="cambiarFoto(${usuario.id})">

    <i class="bi bi-image"></i>

</button>
</div>
    </td>

</tr>
`;
  });

  document.querySelector("#tablaUsuarios tbody").innerHTML = html;
  $("#tablaUsuarios").DataTable({
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
      [5, 10, 15, -1],
      [5, 10, 15, "Todos"],
    ],

    order: [[2, "asc"]],
  });
}

async function cargarRoles() {
  let response = await fetch(IRL + "/api/usuarios/obtener_roles.php");
  let data = await response.json();
  let html = '<option value="">Seleccione</option>';
  data.forEach((rol) => {
    html += `
            <option value="${rol.id}">
                ${rol.nombre}
            </option>
        `;
  });
  document.getElementById("rol_id").innerHTML = html;
}

async function guardarUsuario(e) {
  e.preventDefault();
  let formData = new FormData();
  formData.append("rol_id", document.getElementById("rol_id").value);
  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("usuario", document.getElementById("usuario").value);

  formData.append("correo", document.getElementById("correo").value);

  formData.append("password", document.getElementById("password").value);

  let imagen = document.getElementById("imagen").files[0];

  if (imagen) {
    formData.append("imagen", imagen);
  }
  let id = document.getElementById("formUsuario").dataset.id;
  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id
      ? IRL + "/api/usuarios/actualizar.php"
      : IRL + "/api/usuarios/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Usuario guardado");

    document.getElementById("formUsuario").reset();

    delete document.getElementById("formUsuario").dataset.id;
    bootstrap.Modal.getInstance(document.getElementById("modalUsuario")).hide();
    cargarUsuarios();
  } else {
    alert("Error al guardar");
  }
}
async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_USUARIOS) {
    alert(`No tiene permiso para poner usuarios ${nuevoEstado}`);

    return;
  }
  let response = await fetch(IRL + "/api/usuarios/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarUsuarios();
  }
}
async function editarUsuario(id) {
  if (!PUEDE_EDITAR_USUARIOS) {
    alert("No tiene permiso para editar usuarios");

    return;
  }
  let response = await fetch(IRL + "/api/usuarios/obtener.php?id=" + id);

  let usuario = await response.json();
  document.getElementById("password").placeholder =
    "Dejar vacío, contraseña no editable";
  document.getElementById("password").required = false;
  document.getElementById("nombre").value = usuario.nombre;

  document.getElementById("usuario").value = usuario.usuario;

  document.getElementById("correo").value = usuario.correo;

  document.getElementById("rol_id").value = usuario.rol_id;

  document.getElementById("formUsuario").dataset.id = usuario.id;
  new bootstrap.Modal(document.getElementById("modalUsuario")).show();
}
function cambiarFoto(id) {
  if (!PUEDE_EDITAR_USUARIOS) {
    alert("No tiene permiso para cambiar imagen");
    return;
  }
  document.getElementById("usuario_imagen_id").value = id;

  let modal = new bootstrap.Modal(document.getElementById("modalImagen"));

  modal.show();
}
async function guardarImagen() {
  let id = document.getElementById("usuario_imagen_id").value;

  let archivo = document.getElementById("nueva_imagen").files[0];
  if (!archivo) {
    alert("Seleccione una imagen");

    return;
  }

  let formData = new FormData();

  formData.append("id", id);

  formData.append("imagen", archivo);

  let response = await fetch(IRL + "/api/usuarios/cambiar_foto.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    alert("Foto actualizada");
    bootstrap.Modal.getInstance(document.getElementById("modalImagen")).hide();
    cargarUsuarios();
  } else {
    alert("Error al actualizar foto");
  }
  document.getElementById("nueva_imagen").value = "";
}

function nuevoUsuario() {
  if (!PUEDE_CREAR_USUARIOS) {
    alert("No tiene permiso para crear usuarios");

    return;
  }
  document.getElementById("formUsuario").reset();

  delete document.getElementById("formUsuario").dataset.id;

  new bootstrap.Modal(document.getElementById("modalUsuario")).show();
  document.getElementById("password").placeholder = "Ingrese la contraseña";
  document.getElementById("password").required = true;
}
