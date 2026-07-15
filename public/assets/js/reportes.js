// ? VENTAS
async function buscarVentas() {
  let inicio = document.getElementById("fecha_inicio").value;
  let fin = document.getElementById("fecha_fin").value;
  let response = await fetch(
    IRL + "/api/reportes/ventas.php?inicio=" + inicio + "&fin=" + fin,
  );
  let data = await response.json();
  let html = "";
  let total = 0;
  // let cantidadActivas = 0;
  let mayor = 0;

  data.forEach((venta) => {
    if (venta.estado === "COMPLETADA") {
      let monto = parseFloat(venta.total);

      total += monto;

      // cantidadActivas++;

      if (monto > mayor) {
        mayor = monto;
      }
    }
    let estado =
      venta.estado == "COMPLETADA"
        ? `<span class="badge bg-success">COMPLETADA</span>`
        : `<span class="badge bg-danger">ANULADA</span>`;
    html += `
    <tr>

<td>${venta.id}</td>

<td>${venta.fecha}</td>

<td>${venta.cliente}</td>

<td>${venta.usuario}</td>

<td>C$ ${venta.total}</td>
<td>${estado}

</td>
<td>
<div class="btn-group">

${
  venta.estado === "COMPLETADA"
    ? `<button
        class="btn btn-outline-danger btn-sm"
        onclick="anularVenta(${venta.id})">

        <i class="bi bi-x-circle"></i>
        Anular
    </button>`
    : `<button
    class="btn btn-secondary btn-sm"
    disabled
    title="Venta anulada">

    <i class="bi bi-check2-circle"></i>

      Anulada

</button>`
}

 <button
        class="btn btn-outline-primary btn-sm"
        onclick="verFactura(${venta.id})">

        <i class="bi bi-file-earmark-pdf"></i>

    </button>

</div>

</td>

</tr>
`;
  });
  document.getElementById("cantidadVentas").innerText = data.length;

  document.getElementById("totalGeneral").innerText = "C$ " + total.toFixed(2);

  let promedio = data.length > 0 ? total / data.length : 0;

  document.getElementById("promedioVenta").innerText =
    "C$ " + promedio.toFixed(2);
  document.getElementById("ventaMayor").innerText = "C$ " + mayor.toFixed(2);
  document.querySelector("#tablaVentas tbody").innerHTML = html;
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
function exportarExcelVentas() {
  if (!PUEDE_EXPORTAR_EXCEL) {
    alert(`No tiene permiso para exportar excel`);
    return;
  }
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  window.open(
    IRL +
      "/api/reportes/exportar_ventas_fecha.php?inicio=" +
      inicio +
      "&fin=" +
      fin,

    "_blank",
  );
}
// ? GASTOS
async function buscarGastos() {
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  let response = await fetch(
    IRL + "/api/reportes/gastos.php?inicio=" + inicio + "&fin=" + fin,
  );

  let data = await response.json();

  let html = "";
  let total = 0;
  let mayor = 0;
  data.forEach((gasto) => {
    let monto = parseFloat(gasto.monto);

    total += monto;
    if (monto > mayor) {
      mayor = monto;
    }
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
      <div class="btn-group">
          ${
            gasto.archivo_factura
              ? `<a
                  href="${IRL}/public/uploads/gastos/${gasto.archivo_factura}"
                  target="_blank"
                  title="Ver comprobante"
                   class="btn btn-outline-primary btn-sm">

                 <i class="bi bi-file-earmark-image"></i>

              </a>`
              : `
                <button
                    class="btn btn-secondary btn-sm"
                    disabled
                    title="Sin comprobante">

                    <i class="bi bi-file-earmark-x"></i>

                </button>
                `
          }
       </div>   
      </td>
    </tr>

    `;
  });

  document.getElementById("cantidadGastos").innerText = data.length;

  document.getElementById("totalGeneral").innerText = "C$ " + total.toFixed(2);

  let promedio = data.length > 0 ? total / data.length : 0;

  document.getElementById("promedioGasto").innerText =
    "C$ " + promedio.toFixed(2);
  document.getElementById("gastoMayor").innerText = "C$ " + mayor.toFixed(2);
  document.querySelector("#tablaGastos tbody").innerHTML = html;
}
async function exportarExcelGastos() {
  if (!PUEDE_EXPORTAR_EXCEL) {
    alert(`No tiene permiso para exportar excel`);
    return;
  }
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;
  window.open(
    IRL +
      "/api/reportes/exportar_gastos_fecha.php?inicio=" +
      inicio +
      "&fin=" +
      fin,

    "_blank",
  );
}
// ? COMPRAS
async function buscarCompras() {
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  let response = await fetch(
    IRL + "/api/reportes/compras.php?inicio=" + inicio + "&fin=" + fin,
  );

  let data = await response.json();

  let html = "";

  let total = 0;
  let mayor = 0;
  data.forEach((compra) => {
    if (compra.estado === "COMPLETADA") {
      let monto = parseFloat(compra.total);

      total += monto;
      if (monto > mayor) {
        mayor = monto;
      }
    }
    let estado =
      compra.estado == "COMPLETADA"
        ? `<span class="badge bg-success">COMPLETADA</span>`
        : `<span class="badge bg-danger">ANULADA</span>`;
    html += `

    <tr>

      <td>${compra.id}</td>

      <td>${compra.fecha}</td>

      <td>${compra.proveedor}</td>

      <td>${compra.usuario}</td>

      <td>${compra.total}</td>
      <td>${estado}</td>
      <td>
    <div class="btn-group">

        ${
          compra.estado === "COMPLETADA"
            ? `
        <button
            class="btn btn-outline-danger btn-sm"
            onclick="anularCompra(${compra.id})"
            title="Anular compra">

            <i class="bi bi-x-circle"></i>

        </button>
        `
            : `
        <button
            class="btn btn-secondary btn-sm"
            disabled
            title="Compra anulada">

            <i class="bi bi-check2-circle"></i>

        </button>
        `
        }

        ${
          compra.archivo_factura
            ? `
        <a
            href="${IRL}/public/${compra.archivo_factura}"
            target="_blank"
            class="btn btn-outline-primary btn-sm"
            title="Ver factura">

            <i class="bi bi-file-earmark-pdf"></i>

        </a>
        `
            : `
        <button
            class="btn btn-secondary btn-sm"
            disabled
            title="Sin factura">

            <i class="bi bi-file-earmark-x"></i>

        </button>
        `
        }

        <button
            class="btn btn-outline-warning btn-sm"
            onclick="cambiarComprobante(${compra.id})"
            title="Cambiar comprobante">

            <i class="bi bi-image"></i>

        </button>

    </div>

</td>


    </tr>

    `;
  });
  document.getElementById("cantidadCompras").innerText = data.length;

  document.getElementById("totalGeneral").innerText = "C$ " + total.toFixed(2);

  let promedio = data.length > 0 ? total / data.length : 0;

  document.getElementById("promedioCompra").innerText =
    "C$ " + promedio.toFixed(2);
  document.getElementById("compraMayor").innerText = "C$ " + mayor.toFixed(2);
  document.querySelector("#tablaCompras tbody").innerHTML = html;
}
async function cambiarComprobante(id) {
  if (!PUEDE_EDITAR_COMPRAS) {
    alert("No tiene permiso para cambiar el comprobante");
    return;
  }
  document.getElementById("compra_imagen_id").value = id;

  let modal = new bootstrap.Modal(document.getElementById("modalImagen"));

  modal.show();
}
async function guardarImagen() {
  let id = document.getElementById("compra_imagen_id").value;

  let archivo = document.getElementById("nueva_imagen").files[0];

  if (!archivo) {
    alert("Seleccione una imagen");
    return;
  }
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
    bootstrap.Modal.getInstance(document.getElementById("modalImagen")).hide();
    buscarCompras();
  } else {
    alert("No se pudo actualizar el comprobante");
  }
  document.getElementById("nueva_imagen").value = "";
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
function exportarExcelCompras() {
  if (!PUEDE_EXPORTAR_EXCEL) {
    alert(`No tiene permiso para exportar excel`);
    return;
  }
  let inicio = document.getElementById("fecha_inicio").value;

  let fin = document.getElementById("fecha_fin").value;

  window.open(
    IRL +
      "/api/reportes/exportar_compras_fecha.php?inicio=" +
      inicio +
      "&fin=" +
      fin,

    "_blank",
  );
}
// ? EXCEL

function exportar(ruta) {
  if (!PUEDE_EXPORTAR_EXCEL) {
    alert("No tiene permiso para exportar Excel");
    return;
  }

  window.open(IRL + ruta, "_blank");
}
function exportarInventario() {
  exportar("/api/reportes/exportar_inventario.php");
}

function exportarClientes() {
  exportar("/api/reportes/exportar_clientes.php");
}

function exportarGastos() {
  exportar("/api/reportes/exportar_gastos.php");
}

function exportarVentas() {
  exportar("/api/reportes/exportar_ventas.php");
}

function exportarVentasDetalladas() {
  exportar("/api/reportes/exportar_ventas_detalladas.php");
}

function exportarCompras() {
  exportar("/api/reportes/exportar_compras.php");
}

function exportarComprasDetalladas() {
  exportar("/api/reportes/exportar_compras_detalladas.php");
}

function exportarBitacora() {
  exportar("/api/reportes/exportar_bitacora.php");
}
