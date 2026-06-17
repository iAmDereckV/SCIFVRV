document.addEventListener("DOMContentLoaded", cargarBitacora);

async function cargarBitacora() {
  let response = await fetch(IRL + "/api/bitacora/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((mov) => {
    html += `

    <tr>

      <td>${mov.fecha}</td>

      <td>${mov.tipo}</td>

      <td>${mov.referencia}</td>

      <td>${mov.descripcion}</td>

      <td>${mov.entrada}</td>

      <td>${mov.salida}</td>

      <td>${mov.usuario}</td>

    </tr>

    `;
  });

  document.querySelector("#tablaBitacora tbody").innerHTML = html;
}
