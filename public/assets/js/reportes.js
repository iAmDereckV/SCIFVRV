async function buscarVentas() {
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  let response = await fetch(
    IRL + "/api/reportes/ventas.php?inicio=" + inicio + "&fin=" + fin,
  );

  let data = await response.json();

  let html = "";

  let total = 0;

  data.forEach((venta) => {
    total += parseFloat(venta.total);

    html += `
<tr>

<td>${venta.id}</td>

<td>${venta.fecha}</td>

<td>${venta.cliente}</td>

<td>${venta.usuario}</td>

<td>C$ ${venta.total}</td>
<td>${venta.estado}

</td>
<td>
${
  venta.estado === "COMPLETADA"
    ? `<button
        class="btn btn-danger btn-sm"
        onclick="anularVenta(${venta.id})">

        Anular

    </button>`
    : "-"
}
</td>
<td>

    <button
        class="btn btn-sm btn-danger"
        onclick="verFactura(${venta.id})">

        PDF

    </button>





</td>
</tr>
`;
  });

  document.getElementById("tbodyReporte").innerHTML = html;

  document.getElementById("totalGeneral").innerText = total.toFixed(2);
}
async function buscarCompras() {
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  let response = await fetch(
    IRL + "/api/reportes/compras.php?inicio=" + inicio + "&fin=" + fin,
  );

  let data = await response.json();

  let html = "";

  let total = 0;

  data.forEach((compra) => {
    total += parseFloat(compra.total);

    html += `

    <tr>

      <td>${compra.id}</td>

      <td>${compra.fecha}</td>

      <td>${compra.proveedor}</td>

      <td>${compra.usuario}</td>

      <td>${compra.total}</td>
      <td>${compra.estado}</td>
      <td>
${
  compra.estado === "COMPLETADA"
    ? `<button
        class="btn btn-danger btn-sm"
        onclick="anularCompra(${compra.id})">

        Anular

    </button>`
    : "-"
}
</td>
   <td>
          ${
            compra.archivo_factura
              ? `<a
                  href="${IRL}/public/${compra.archivo_factura}"
                  target="_blank"
                  class="btn btn-info btn-sm">

                  Ver

              </a>`
              : "-"
          }
<button
    class="btn btn-warning btn-sm"
    onclick="cambiarComprobante(${compra.id})">

    Cambiar

</button>

</td>

    </tr>

    `;
  });

  document.getElementById("tbodyReporte").innerHTML = html;

  document.getElementById("totalGeneral").innerText = total.toFixed(2);
}
async function buscarGastos() {
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  let response = await fetch(
    IRL + "/api/reportes/gastos.php?inicio=" + inicio + "&fin=" + fin,
  );

  let data = await response.json();

  let html = "";

  let total = 0;

  data.forEach((gasto) => {
    console.log(gasto);
    total += parseFloat(gasto.monto);

    html += `

    <tr>

      <td>${gasto.id}</td>

      <td>${gasto.fecha}</td>

      <td>${gasto.categoria}</td>

      <td>${gasto.descripcion}</td>

      <td>${gasto.usuario}</td>

      <td>C$ ${gasto.monto}</td>
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
    </tr>

    `;
  });

  document.getElementById("tbodyReporte").innerHTML = html;

  document.getElementById("totalGeneral").innerText = total.toFixed(2);
}
function verFactura(id) {
  window.open(IRL + "/api/ventas/factura_pdf.php?id=" + id, "_blank");
}
async function anularVenta(id) {
  if (!PUEDE_CAMBIAR_ESTADO_VENTAS) {
    alert(`No tiene permiso para poner ventas ${nuevoEstado}`);
    return;
  }
  if (!confirm("¿Desea anular esta venta?")) {
    return;
  }
  let response = await fetch(IRL + "/api/ventas/anular.php?id=" + id);

  let data = await response.json();

  if (data.success) {
    alert("Venta anulada");

    buscarVentas();
  } else {
    alert("No se pudo anular");
  }
}
async function anularCompra(id) {
  if (!PUEDE_CAMBIAR_ESTADO_COMPRAS) {
    alert(`No tiene permiso para poner compras ${nuevoEstado}`);
    return;
  }
  if (!confirm("¿Desea anular esta compra?")) {
    return;
  }
  let response = await fetch(IRL + "/api/compras/anular.php?id=" + id);

  let data = await response.json();

  if (data.success) {
    alert("Compra anulada");

    buscarCompras();
  } else {
    alert("No se pudo anular");
  }
}
async function cambiarComprobante(id) {
  if (!PUEDE_EDITAR_COMPRAS) {
    alert("No tiene permiso para cambiar el comprobante");
    return;
  }

  let input = document.createElement("input");

  input.type = "file";
  input.accept = ".jpg,.jpeg,.png,.pdf";

  input.onchange = async () => {
    let archivo = input.files[0];

    if (!archivo) return;

    let formData = new FormData();

    formData.append("id", id);
    formData.append("archivo_factura", archivo);

    let response = await fetch(IRL + "/api/compras/cambiar_comprobante.php", {
      method: "POST",
      body: formData,
    });

    let data = await response.json();

    if (data.success) {
      alert("Comprobante actualizado");

      buscarVentas();
    } else {
      alert("No se pudo actualizar el comprobante");
    }
  };

  input.click();
}
