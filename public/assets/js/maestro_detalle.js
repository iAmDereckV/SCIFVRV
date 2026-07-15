document.addEventListener("DOMContentLoaded", async () => {
  await cargarAnios();

  cargarResumen();
});

document.getElementById("btnExcel").addEventListener("click", () => {
  let anio = document.getElementById("anio").value;

  window.location.href =
    IRL + "/api/reportes/exportar_maestro_detalle.php?anio=" + anio;
});
document.getElementById("anio").addEventListener("change", cargarResumen);
document.getElementById("btnExcel").addEventListener("click", () => {
  let anio = document.getElementById("anio").value;

  window.location.href =
    IRL + "/api/reportes/exportar_maestro_detalle.php?anio=" + anio;
});

async function cargarAnios() {
  let response = await fetch(IRL + "/api/maestro_detalle/anios.php");
  let anios = await response.json();

  let html = "";

  anios.forEach((anio) => {
    html += `
      <option value="${anio}">
        ${anio}
      </option>
    `;
  });

  document.getElementById("anio").innerHTML = html;
}
async function cargarResumen() {
  if ($.fn.DataTable.isDataTable("#tablaMaestroDetalle")) {
    $("#tablaMaestroDetalle").DataTable().destroy();
  }

  let anio = document.getElementById("anio").value;

  let response = await fetch(
    IRL + "/api/maestro_detalle/listar.php?anio=" + anio,
  );

  let data = await response.json();

  let html = "";

  data.forEach((fila) => {
    html += `

    <tr>

      <td>${fila.concepto}</td>
      <td>C$ ${Number(fila.enero).toFixed(2)}</td>
      <td>C$ ${Number(fila.febrero).toFixed(2)}</td>
      <td>C$ ${Number(fila.marzo).toFixed(2)}</td>
      <td>C$ ${Number(fila.abril).toFixed(2)}</td>
      <td>C$ ${Number(fila.mayo).toFixed(2)}</td>
      <td>C$ ${Number(fila.junio).toFixed(2)}</td>
      <td>C$ ${Number(fila.julio).toFixed(2)}</td>
      <td>C$ ${Number(fila.agosto).toFixed(2)}</td>
      <td>C$ ${Number(fila.septiembre).toFixed(2)}</td>
      <td>C$ ${Number(fila.octubre).toFixed(2)}</td>
      <td>C$ ${Number(fila.noviembre).toFixed(2)}</td>
      <td>C$ ${Number(fila.diciembre).toFixed(2)}</td>
      <td>C$ ${Number(fila.total).toFixed(2)}</td>

    </tr>

    `;
  });

  document.querySelector("#tablaMaestroDetalle tbody").innerHTML = html;
  $("#tablaMaestroDetalle").DataTable({
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

    pageLength: -1,

    lengthMenu: [[-1], ["Todos"]],

    order: [[2, "asc"]],
  });
}
