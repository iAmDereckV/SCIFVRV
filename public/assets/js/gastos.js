document.addEventListener("DOMContentLoaded", () => {
  cargarCategorias();
  cargarGastos();

  document.getElementById("formGasto").addEventListener("submit", guardarGasto);
});
async function cargarGastos() {
  let response = await fetch(IRL + "/api/gastos/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((gasto) => {
    html += `
        <tr>

            <td>${gasto.fecha}</td>

            <td>${gasto.categoria}</td>

            <td>${gasto.descripcion}</td>

            <td>C$ ${gasto.monto}</td>

            <td>${gasto.usuario}</td> 
            
            <td>
    ${
      gasto.archivo_factura
        ? `<a
            href="${IRL}/public/uploads/gastos/${gasto.archivo_factura}"
            target="_blank"
            class="btn btn-info btn-sm">

            Ver

         </a>`
        : "-"
    }
</td>
            <td>

<button
    class="btn btn-warning btn-sm"
    onclick="editarGasto(${gasto.id})">

    Editar

</button>

<button
    class="btn btn-secondary btn-sm"
    onclick="cambiarComprobante(${gasto.id})">

    Comprobante

</button>

</td>

        </tr>
        `;
  });

  document.getElementById("tbodyGastos").innerHTML = html;
}

async function guardarGasto(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append(
    "categoria_id",
    document.getElementById("categoria_id").value,
  );

  formData.append("descripcion", document.getElementById("descripcion").value);

  formData.append("monto", document.getElementById("monto").value);

  formData.append("fecha", document.getElementById("fecha").value);
  let id = document.getElementById("formGasto").dataset.id;
  if (!id && !PUEDE_CREAR_GASTOS) {
    alert("No tiene permiso para crear gastos");

    return;
  }

  if (id && !PUEDE_EDITAR_GASTOS) {
    alert("No tiene permiso para editar gastos");

    return;
  }
  if (id) {
    formData.append("id", id);
  }
  let archivo = document.getElementById("archivo_factura").files[0];

  if (archivo) {
    formData.append("archivo_factura", archivo);
  }
  let response = await fetch(
    id ? IRL + "/api/gastos/actualizar.php" : IRL + "/api/gastos/guardar.php",

    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    document.getElementById("formGasto").reset();
    delete document.getElementById("formGasto").dataset.id;
    cargarGastos();
  }
}

async function cargarCategorias() {
  let response = await fetch(IRL + "/api/gastos/categorias.php");

  let data = await response.json();

  let html = '<option value="">Seleccione</option>';

  data.forEach((categoria) => {
    html += `
            <option value="${categoria.id}">
                ${categoria.nombre}
            </option>
        `;
  });

  document.getElementById("categoria_id").innerHTML = html;
}
async function editarGasto(id) {
  let response = await fetch("/SCIFVRV/api/gastos/obtener.php?id=" + id);

  let gasto = await response.json();

  document.getElementById("categoria_id").value = gasto.categoria_id;

  document.getElementById("descripcion").value = gasto.descripcion;

  document.getElementById("monto").value = gasto.monto;

  document.getElementById("fecha").value = gasto.fecha;

  document.getElementById("formGasto").dataset.id = gasto.id;
}
async function cambiarComprobante(id) {
  if (!PUEDE_EDITAR_GASTOS) {
    alert("No tiene permiso para cambiar comprobante");

    return;
  }
  let input = document.createElement("input");

  input.type = "file";

  input.onchange = async () => {
    let archivo = input.files[0];

    let formData = new FormData();

    formData.append("id", id);

    formData.append("archivo_factura", archivo);

    let response = await fetch(
      IRL + "/api/gastos/cambiar_comprobante.php",

      {
        method: "POST",
        body: formData,
      },
    );

    let data = await response.json();

    if (data.success) {
      alert("Comprobante actualizado");

      cargarGastos();
    }
  };

  input.click();
}
