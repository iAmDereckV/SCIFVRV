document.addEventListener("DOMContentLoaded", cargarBitacora);
async function cargarBitacora() {
  if ($.fn.DataTable.isDataTable("#tablaBitacora")) {
    $("#tablaBitacora").DataTable().destroy();
  }
  let response = await fetch(IRL + "/api/bitacora/listar.php");
  let data = await response.json();
  let html = "";
  let entradas = 0;
  let salidas = 0;
  let usuarios = new Set();
  data.forEach((mov) => {
    entradas += Number(mov.entrada);
    salidas += Number(mov.salida);
    usuarios.add(mov.usuario);
    html += `
<tr>
<td>${mov.fecha}</td>
<td>
<span class="badge ${
      mov.tipo == "VENTA"
        ? "bg-success"
        : mov.tipo == "COMPRA"
          ? "bg-primary"
          : mov.tipo == "GASTO"
            ? "bg-warning text-dark"
            : "bg-secondary"
    }">
${mov.tipo}
</span>
</td>
<td>${mov.referencia}</td>
<td>${mov.descripcion}</td>
<td class="text-success fw-bold">
C$ ${mov.entrada}
</td>
<td class="text-danger fw-bold">
C$ ${mov.salida}
</td>
<td>${mov.usuario}</td>
</tr>
`;
  });
  document.getElementById("totalRegistros").innerText = data.length;
  document.getElementById("totalEntradas").innerText = "C$ " + entradas;
  document.getElementById("totalSalidas").innerText = "C$ " + salidas;
  document.getElementById("totalUsuarios").innerText = usuarios.size;
  document.querySelector("#tablaBitacora tbody").innerHTML = html;
  $("#tablaBitacora").DataTable({
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
      [5, 10, 15, -1],
      [5, 10, 15, "Todos"],
    ],
    order: [[2, "asc"]],
  });
}

function exportarBitacora() {
  if (!PUEDE_EXPORTAR_EXCEL) {
    alert("No tiene permiso para exportar Excel");
    return;
  }
  window.open(IRL + "/api/reportes/exportar_bitacora.php", "_blank");
}
