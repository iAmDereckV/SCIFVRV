document.addEventListener("DOMContentLoaded", () => {
  cargarMarcas();

  document.getElementById("formMarca").addEventListener("submit", guardarMarca);
});

async function cargarMarcas() {
  let response = await fetch(IRL + "/api/marcas/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((marca) => {
    html += `
      <tr>

        <td>${marca.id}</td>

        <td>${marca.nombre}</td>

        <td>${marca.descripcion ?? ""}</td>

        <td>${marca.estado}</td>

        <td>

          <button
            class="btn btn-warning btn-sm"
            onclick="editarMarca(${marca.id})">

            Editar

          </button>

          <button
            class="btn btn-danger btn-sm"
            onclick="cambiarEstado(
                ${marca.id},
                '${marca.estado}'
            )">

            Estado

          </button>

        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaMarcas tbody").innerHTML = html;
}

async function guardarMarca(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("descripcion", document.getElementById("descripcion").value);

  let id = document.getElementById("formMarca").dataset.id;
  if (!id && !PUEDE_CREAR_MARCAS) {
    alert("No tiene permiso para crear marcas");

    return;
  }

  if (id && !PUEDE_EDITAR_MARCAS) {
    alert("No tiene permiso para editar marcas");

    return;
  }
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

    cargarMarcas();
  }
}

async function editarMarca(id) {
  let response = await fetch(IRL + "/api/marcas/obtener.php?id=" + id);

  let marca = await response.json();

  document.getElementById("nombre").value = marca.nombre;

  document.getElementById("descripcion").value = marca.descripcion;

  document.getElementById("formMarca").dataset.id = marca.id;
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
