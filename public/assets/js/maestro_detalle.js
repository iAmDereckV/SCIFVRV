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

      <td>${fila.enero}</td>
      <td>${fila.febrero}</td>
      <td>${fila.marzo}</td>
      <td>${fila.abril}</td>
      <td>${fila.mayo}</td>
      <td>${fila.junio}</td>
      <td>${fila.julio}</td>
      <td>${fila.agosto}</td>
      <td>${fila.septiembre}</td>
      <td>${fila.octubre}</td>
      <td>${fila.noviembre}</td>
      <td>${fila.diciembre}</td>

      <td>${fila.total}</td>

    </tr>

    `;
  });

  document.querySelector("#tablaMaestroDetalle tbody").innerHTML = html;
}
