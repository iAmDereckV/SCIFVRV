document.addEventListener("DOMContentLoaded", () => {
  cargarClientes();
  cargarTipoCliente();
  document
    .getElementById("formCliente")
    .addEventListener("submit", guardarCliente);
});

async function cargarClientes() {
  if ($.fn.DataTable.isDataTable("#tablaClientes")) {
    $("#tablaClientes").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/clientes/listar.php");
  let data = await response.json();
  let html = "";
  data.forEach((cliente) => {
    let estado =
      cliente.estado == "ACTIVO"
        ? `<span class="badge bg-success">Activo</span>`
        : `<span class="badge bg-danger">Inactivo</span>`;
    html += `
      <tr>
        <td>${cliente.id}</td>
        <td>${cliente.nombres} ${cliente.apellidos ?? ""}</td>
        <td>${cliente.identificacion ?? ""}</td>
        <td>${cliente.telefono ?? ""}</td>
        <td>${cliente.correo ?? ""}</td>
        <td>${cliente.tipo_cliente}</td>
        <td>${estado}</td>
        <td>
        <div class="btn-group">
        <button
      title="Editar"
          class="btn btn-sm btn-outline-primary"
      onclick="editarCliente(${cliente.id})">
       <i class="bi bi-pencil-square"></i>
    </button>
    <a
    href="https://wa.me/505${cliente.telefono.replace(/\D/g, "")}"
    target="_blank"
    class="btn btn-sm btn-outline-success"
    title="Enviar WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>
       <button
    title="Estado"
    class="btn btn-sm ${
      cliente.estado === "ACTIVO" ? "btn-outline-danger" : "btn-outline-success"
    }"
    onclick="cambiarEstado(
        ${cliente.id},
        '${cliente.estado}'
    )">
    <i class="bi bi-arrow-repeat"></i>
</button>
    </div>
   </td>
      </tr>
    `;
  });
  document.querySelector("#tablaClientes tbody").innerHTML = html;
  $("#tablaClientes").DataTable({
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

async function cargarTipoCliente() {
  let response = await fetch(IRL + "/api/clientes/tipos.php");
  let data = await response.json();
  let html = '<option value="">Seleccione tipo</option>';
  data.forEach((tipo) => {
    html += `
            <option value="${tipo}">
                ${tipo}
            </option>
        `;
  });
  document.getElementById("tipo_cliente").innerHTML = html;
}

function nuevoCliente() {
  if (!PUEDE_CREAR_CLIENTES) {
    alert("No tiene permiso para crear clientes");
    return;
  }
  document.getElementById("formCliente").reset();
  delete document.getElementById("formCliente").dataset.id;
  new bootstrap.Modal(document.getElementById("modalCliente")).show();
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
    bootstrap.Modal.getInstance(document.getElementById("modalCliente")).hide();
    cargarClientes();
  } else {
    alert("Error al guardar cliente");
  }
}

async function editarCliente(id) {
  if (!PUEDE_EDITAR_CLIENTES) {
    alert("No tiene permiso para editar clientes");
    return;
  }
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
  new bootstrap.Modal(document.getElementById("modalCliente")).show();
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";
  if (!PUEDE_CAMBIAR_ESTADO_CLIENTES) {
    alert(`No tiene permiso para poner clientes ${nuevoEstado}`);
    return;
  }
  let formData = new FormData();
  formData.append("id", id);
  formData.append("estado", nuevoEstado);
  let response = await fetch(IRL + "/api/clientes/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    cargarClientes();
  } else {
    alert(`Error al poner cliente ${nuevoEstado}`);
  }
}
