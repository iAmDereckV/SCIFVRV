document.addEventListener("DOMContentLoaded", () => {
  cargarUsuarios();
  cargarRoles();

  document
    .getElementById("formUsuario")
    .addEventListener("submit", guardarUsuario);
});

async function cargarUsuarios() {
  let response = await fetch(IRL + "/api/usuarios/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((usuario) => {
    let foto = usuario.foto
      ? `uploads/usuarios/${usuario.foto}`
      : `assets/img/sin-imagen.png`;

    html += `
<tr>

    <td>${usuario.id}</td>
    <td>
<img
    src="${foto}"
    width="60"
    height="60"
    style="object-fit:cover;">

</td>
    <td>${usuario.nombre}</td>

    <td>${usuario.usuario}</td>

    <td>${usuario.rol}</td>

    <td>${usuario.estado}</td>
   
    <td>

<button
    class="btn btn-warning btn-sm"
    onclick="editarUsuario(${usuario.id})">

    Editar

</button>

        <button
            class="btn btn-danger btn-sm"
            onclick="
            cambiarEstado(
                ${usuario.id},
                '${usuario.estado}'
            )">

            Estado

        </button>
<button
    class="btn btn-info btn-sm"
    onclick="cambiarFoto(${usuario.id})">

    Foto

</button>
    </td>

</tr>
`;
  });

  document.querySelector("#tablaUsuarios tbody").innerHTML = html;
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
  formData.append("id", document.getElementById("id").value);
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
  let response = await fetch(IRL + "/api/usuarios/obtener.php?id=" + id);

  let usuario = await response.json();

  document.getElementById("id").value = usuario.id;
  document.getElementById("nombre").value = usuario.nombre;

  document.getElementById("usuario").value = usuario.usuario;

  document.getElementById("correo").value = usuario.correo;

  document.getElementById("rol_id").value = usuario.rol_id;

  document.getElementById("formUsuario").dataset.id = usuario.id;
}
async function cambiarFoto(id) {
  let input = document.createElement("input");

  input.type = "file";

  input.accept = "image/*";

  input.onchange = async () => {
    let archivo = input.files[0];

    if (!archivo) return;

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

      cargarUsuarios();
    } else {
      alert("Error al actualizar foto");
    }
  };

  input.click();
}
