document.addEventListener("DOMContentLoaded", () => {
  cargarCategorias();

  document
    .getElementById("formCategoria")
    .addEventListener("submit", guardarCategoria);
});

async function cargarCategorias() {
  let response = await fetch(IRL + "/api/categorias/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((categoria) => {
    html += `
      <tr>

        <td>${categoria.id}</td>

        <td>${categoria.nombre}</td>

        <td>${categoria.descripcion ?? ""}</td>

        <td>${categoria.estado}</td>

        <td>

          <button
            class="btn btn-warning btn-sm"
            onclick="editarCategoria(${categoria.id})">

            Editar

          </button>

          <button
            class="btn btn-danger btn-sm"
            onclick="cambiarEstado(
                ${categoria.id},
                '${categoria.estado}'
            )">

            Estado

          </button>

        </td>

      </tr>
    `;
  });

  document.querySelector("#tablaCategorias tbody").innerHTML = html;
}

async function guardarCategoria(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre").value);

  formData.append("descripcion", document.getElementById("descripcion").value);

  let id = document.getElementById("formCategoria").dataset.id;
  if (!id && !PUEDE_CREAR_CATEGORIAS) {
    alert("No tiene permiso para crear categorias");

    return;
  }

  if (id && !PUEDE_EDITAR_CATEGORIAS) {
    alert("No tiene permiso para editar categorias");

    return;
  }
  if (id) {
    formData.append("id", id);
  }

  let response = await fetch(
    id
      ? IRL + "/api/categorias/actualizar.php"
      : IRL + "/api/categorias/guardar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Categoría guardada");

    document.getElementById("formCategoria").reset();

    delete document.getElementById("formCategoria").dataset.id;

    cargarCategorias();
  }
}

async function editarCategoria(id) {
  let response = await fetch(IRL + "/api/categorias/obtener.php?id=" + id);

  let categoria = await response.json();

  document.getElementById("nombre").value = categoria.nombre;

  document.getElementById("descripcion").value = categoria.descripcion;

  document.getElementById("formCategoria").dataset.id = categoria.id;
}

async function cambiarEstado(id, estadoActual) {
  let nuevoEstado = estadoActual === "ACTIVO" ? "INACTIVO" : "ACTIVO";

  let formData = new FormData();

  formData.append("id", id);

  formData.append("estado", nuevoEstado);
  if (!PUEDE_CAMBIAR_ESTADO_CATEGORIAS) {
    alert(`No tiene permiso para poner categorias ${nuevoEstado}`);
    return;
  }

  let response = await fetch(IRL + "/api/categorias/cambiar_estado.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    cargarCategorias();
  }
}
