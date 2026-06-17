let productos = [];

let detalleVenta = [];

document.addEventListener("DOMContentLoaded", () => {
  cargarClientes();

  cargarProductos();
  document
    .getElementById("descuento_valor")
    .addEventListener("input", calcularTotales);

  document
    .getElementById("tipo_descuento")
    .addEventListener("change", calcularTotales);

  document
    .getElementById("porcentaje_impuesto")
    .addEventListener("input", calcularTotales);
});
async function cargarClientes() {
  let response = await fetch(IRL + "/api/ventas/clientes.php");

  let data = await response.json();

  let html = '<option value="">Seleccione</option>';

  data.forEach((cliente) => {
    html += `
            <option value="${cliente.id}">
                ${cliente.nombres}
                ${cliente.apellidos ?? ""}
            </option>
        `;
  });

  document.getElementById("cliente_id").innerHTML = html;
}
async function cargarProductos() {
  let response = await fetch(IRL + "/api/ventas/productos.php");

  productos = await response.json();

  let html = '<option value="">Seleccione</option>';

  productos.forEach((producto) => {
    html += `
            <option value="${producto.id}">
                ${producto.codigo}
                -
                ${producto.nombre}
                (
                Stock:
                ${producto.stock}
                )
            </option>
        `;
  });

  document.getElementById("producto_id").innerHTML = html;
}
function agregarProducto() {
  let producto_id = document.getElementById("producto_id").value;

  let cantidad = parseInt(document.getElementById("cantidad").value);

  if (!producto_id) {
    alert("Seleccione producto");

    return;
  }

  let producto = productos.find((p) => p.id == producto_id);

  if (cantidad > producto.stock) {
    alert("Stock insuficiente");

    return;
  }

  let subtotal = cantidad * producto.precio_venta;

  let existente = detalleVenta.find((item) => item.producto_id == producto.id);

  if (existente) {
    let nuevaCantidad = existente.cantidad + cantidad;

    if (nuevaCantidad > producto.stock) {
      alert("No hay suficiente stock disponible");

      return;
    }

    existente.cantidad = nuevaCantidad;

    existente.subtotal = existente.cantidad * existente.precio;
  } else {
    detalleVenta.push({
      producto_id: producto.id,

      nombre: producto.nombre,

      precio: producto.precio_venta,

      cantidad: cantidad,

      subtotal: subtotal,
    });
  }

  renderDetalle();
}
function renderDetalle() {
  let html = "";

  let total = 0;

  detalleVenta.forEach((item, index) => {
    total += parseFloat(item.subtotal);

    html += `
            <tr>

                <td>
                    ${item.nombre}
                </td>

                <td>
                    ${item.precio}
                </td>

                <td>
                    ${item.cantidad}
                </td>

                <td>
                    ${item.subtotal}
                </td>

                <td>

                    <button
                        class="btn btn-danger btn-sm"
                        onclick="eliminarProducto(${index})">

                        X

                    </button>

                </td>

            </tr>
        `;
  });

  document.querySelector("#tablaDetalle tbody").innerHTML = html;

  calcularTotales();
}
function eliminarProducto(index) {
  detalleVenta.splice(index, 1);

  renderDetalle();
}
async function guardarVenta() {
  let cliente_id = document.getElementById("cliente_id").value;

  if (!cliente_id) {
    alert("Seleccione un cliente");

    return;
  }

  if (detalleVenta.length === 0) {
    alert("Debe agregar productos");

    return;
  }

  let sesion = await fetch(IRL + "/api/auth/session.php");

  let usuario = await sesion.json();

  let subtotal = parseFloat(document.getElementById("subtotal").value);

  let total = parseFloat(document.getElementById("total").value);

  let formData = new FormData();

  formData.append("cliente_id", cliente_id);

  formData.append("usuario_id", usuario.usuario_id);

  formData.append("subtotal", subtotal);

  formData.append("impuesto", document.getElementById("impuesto").value);

  formData.append("descuento", document.getElementById("descuento").value);

  formData.append("total", total);

  formData.append("detalle", JSON.stringify(detalleVenta));

  let response = await fetch(IRL + "/api/ventas/guardar.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    if (confirm("Venta realizada correctamente. ¿Desea imprimir la factura?")) {
      window.open(
        IRL + "/api/ventas/factura_pdf.php?id=" + data.venta_id,
        "_blank",
      );
    }
    detalleVenta = [];
    renderDetalle();
    document.getElementById("descuento_valor").value = 0;

    document.getElementById("descuento").value = 0;

    document.getElementById("subtotal").value = 0;

    document.getElementById("impuesto").value = 0;
    document.getElementById("cantidad").value = 1;

    document.getElementById("total").value = 0;
    document.getElementById("cliente_id").value = "";
    document.getElementById("producto_id").value = "";
  } else {
    console.log(data);

    alert("Error al guardar venta");
  }
}
function calcularTotales() {
  let subtotal = 0;

  detalleVenta.forEach((item) => {
    subtotal += parseFloat(item.subtotal);
  });

  let tipo = document.getElementById("tipo_descuento").value;

  let valor = parseFloat(document.getElementById("descuento_valor").value) || 0;

  let descuento = 0;

  if (tipo === "porcentaje") {
    descuento = subtotal * (valor / 100);
  } else {
    descuento = valor;
  }

  let porcentaje =
    parseFloat(document.getElementById("porcentaje_impuesto").value) || 0;

  let impuesto = (subtotal * porcentaje) / 100;

  let total = subtotal + impuesto - descuento;

  document.getElementById("subtotal").value = subtotal.toFixed(2);

  document.getElementById("impuesto").value = impuesto.toFixed(2);

  document.getElementById("descuento").value = descuento.toFixed(2);

  document.getElementById("total").value = total.toFixed(2);
}
async function anularVenta(id) {
  if (!confirm("¿Desea anular esta venta?")) {
    return;
  }

  let response = await fetch(IRL + "/api/ventas/anular.php?id=" + id);

  let data = await response.json();

  if (data.success) {
    alert("Venta anulada");

    buscarReporte();
  } else {
    alert("No se pudo anular");
  }
}
