document.addEventListener("DOMContentLoaded", () => {
  cargarClientes();

  document
    .getElementById("formCliente")
    .addEventListener("submit", guardarCliente);
});

async function cargarClientes() {
  let response = await fetch(IRL + "/api/clientes/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((cliente) => {
    // let acciones = "";
    //   if (PUEDE_EDITAR_CLIENTES) {
    //     acciones += `
    //   <button
    //     class="btn btn-warning btn-sm"
    //     onclick="editarCliente(${cliente.id})">
    //     Editar
    //   </button>
    // `;
    //   }
    //   if (PUEDE_CAMBIAR_ESTADO_CLIENTES) {
    //     acciones += `
    //   <button
    //     class="btn btn-danger btn-sm"
    //     onclick="cambiarEstado(
    //       ${cliente.id},
    //       '${cliente.estado}'
    //     )">
    //     Estado
    //   </button>
    // `;
    // }
    html += `
      <tr>

        <td>${cliente.id}</td>

        <td>${cliente.nombres} ${cliente.apellidos ?? ""}</td>

        <td>${cliente.identificacion ?? ""}</td>

        <td>${cliente.telefono ?? ""}</td>

        <td>${cliente.tipo_cliente}</td>

        <td>${cliente.estado}</td>

        <td><button
     class="btn btn-warning btn-sm"
      onclick="editarCliente(${cliente.id})">

      Editar

    </button>
       <button
      class="btn btn-danger btn-sm"
      onclick="cambiarEstado(
        ${cliente.id},
        '${cliente.estado}'
      )">

      Estado

    </button>
   </td>

      </tr>
    `;
  });

  document.querySelector("#tablaClientes tbody").innerHTML = html;
}

async function guardarCliente(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombres", document.getElementById("nombres").value);

  formData.append("apellidos", document.getElementById("apellidos").value);

  formData.append("telefono", document.getElementById("telefono").value);

  formData.append("correo", document.getElementById("correo").value);

  formData.append("direccion", document.getElementById("direccion").value);

  formData.append(
    "identificacion",
    document.getElementById("identificacion").value,
  );

  formData.append(
    "tipo_cliente",
    document.getElementById("tipo_cliente").value,
  );

  let id = document.getElementById("formCliente").dataset.id;
  if (!id && !PUEDE_CREAR_CLIENTES) {
    alert("No tiene permiso para crear clientes");

    return;
  }

  if (id && !PUEDE_EDITAR_CLIENTES) {
    alert("No tiene permiso para editar clientes");

    return;
  }
  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id
      ? IRL + "/api/clientes/actualizar.php"
      : IRL + "/api/clientes/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Cliente guardado");

    document.getElementById("formCliente").reset();

    delete document.getElementById("formCliente").dataset.id;

    cargarClientes();
  }
}

async function editarCliente(id) {
  let response = await fetch(IRL + "/api/clientes/obtener.php?id=" + id);

  let cliente = await response.json();

  document.getElementById("nombres").value = cliente.nombres;

  document.getElementById("apellidos").value = cliente.apellidos;

  document.getElementById("telefono").value = cliente.telefono;

  document.getElementById("correo").value = cliente.correo;

  document.getElementById("direccion").value = cliente.direccion;

  document.getElementById("identificacion").value = cliente.identificacion;

  document.getElementById("tipo_cliente").value = cliente.tipo_cliente;

  document.getElementById("formCliente").dataset.id = cliente.id;
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_CLIENTES) {
    alert(`No tiene permiso para poner clientes ${nuevoEstado}`);

    return;
  }

  let response = await fetch(IRL + "/api/clientes/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarClientes();
  }
}
