document.addEventListener("DOMContentLoaded", () => {
  cargarProveedores();

  document
    .getElementById("formProveedor")
    .addEventListener("submit", guardarProveedor);
});

async function cargarProveedores() {
  let response = await fetch(IRL + "/api/proveedores/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((proveedor) => {
    html += `
      <tr>

        <td>${proveedor.id}</td>

        <td>${proveedor.nombre}</td>

        <td>${proveedor.contacto ?? ""}</td>

        <td>${proveedor.telefono ?? ""}</td>

        <td>${proveedor.estado}</td>

        <td>

          <button
            class="btn btn-warning btn-sm"
            onclick="editarProveedor(${proveedor.id})">

            Editar

          </button>

          <button
            class="btn btn-danger btn-sm"
            onclick="
              cambiarEstado(
                ${proveedor.id},
                '${proveedor.estado}'
              )">

            Estado

          </button>

        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaProveedores tbody").innerHTML = html;
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

    cargarProveedores();
  } else {
    alert("Error al guardar");
  }
}

async function editarProveedor(id) {
  let response = await fetch(IRL + "/api/proveedores/obtener.php?id=" + id);

  let proveedor = await response.json();

  document.getElementById("nombre").value = proveedor.nombre;

  document.getElementById("contacto").value = proveedor.contacto;

  document.getElementById("telefono").value = proveedor.telefono;

  document.getElementById("correo").value = proveedor.correo;

  document.getElementById("direccion").value = proveedor.direccion;

  document.getElementById("formProveedor").dataset.id = proveedor.id;
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

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
