let productos = [];
let detalleVenta = [];
let totalVenta = 0;
let subtotalVenta = 0;
let descuentoVenta = 0;
let impuestoVenta = 0;
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
    alertaWarning("Seleccione producto");
    return;
  }
  let producto = productos.find((p) => p.id == producto_id);
  if (cantidad > producto.stock) {
    alertaWarning("Stock insuficiente");
    return;
  }
  let subtotal = cantidad * producto.precio_venta;
  let existente = detalleVenta.find((item) => item.producto_id == producto.id);
  if (existente) {
    let nuevaCantidad = existente.cantidad + cantidad;
    if (nuevaCantidad > producto.stock) {
      alertaWarning("No hay suficiente stock disponible");
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
  document.getElementById("producto_id").value = "";
  document.getElementById("cantidad").value = 1;
  renderDetalle();
}
function actualizarResumen(subtotal, descuento, impuesto, total) {
  document.getElementById("subtotal").textContent = `C$ ${subtotal.toFixed(2)}`;
  document.getElementById("descuento").textContent =
    `C$ ${descuento.toFixed(2)}`;
  document.getElementById("impuesto").textContent = `C$ ${impuesto.toFixed(2)}`;
  document.getElementById("total").textContent = `C$ ${total.toFixed(2)}`;
}
function eliminarProducto(index) {
  detalleVenta.splice(index, 1);
  renderDetalle();
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
  subtotalVenta = subtotal;
  descuentoVenta = descuento;
  impuestoVenta = impuesto;
  totalVenta = subtotal + impuesto - descuento;
  actualizarResumen(subtotal, descuento, impuesto, totalVenta);
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
                  C$ ${item.precio}
                </td>
                <td>
                    ${item.cantidad}
                </td>
                <td>
                  C$ ${item.subtotal}
                </td>
                <td>
                    <button
                        class="btn btn-danger btn-sm"
                        onclick="eliminarProducto(${index})">X</button>
                </td>
            </tr>
        `;
  });
  document.querySelector("#tablaDetalle tbody").innerHTML = html;
  calcularTotales();
}

async function guardarVenta() {
  if (!PUEDE_CREAR_VENTAS) {
    alertaWarning("No tiene permiso para crear ventas");
    return;
  }
  let cliente_id = document.getElementById("cliente_id").value;
  if (!cliente_id) {
    alertaError("Seleccione un cliente");
    return;
  }
  if (detalleVenta.length === 0) {
    alertaError("Debe agregar productos");
    return;
  }
  let sesion = await fetch(IRL + "/api/auth/session.php");
  let usuario = await sesion.json();
  let total = parseFloat(document.getElementById("total").value);
  let formData = new FormData();
  formData.append("cliente_id", cliente_id);
  formData.append("usuario_id", usuario.usuario_id);
  formData.append("subtotal", subtotalVenta);
  formData.append("impuesto", impuestoVenta);
  formData.append("descuento", descuentoVenta);
  formData.append("total", totalVenta);
  formData.append("detalle", JSON.stringify(detalleVenta));
  let response = await fetch(IRL + "/api/ventas/guardar.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    alertaSuccess();
    setTimeout(async () => {
      if (
        await confirmar(
          "Venta realizada correctamente",
          "¿Desea imprimir la factura?",
        )
      ) {
        window.open(
          IRL + "/api/ventas/factura_pdf.php?id=" + data.venta_id,
          "_blank",
        );
      }
    }, 700);
    detalleVenta = [];
    renderDetalle();
    cargarProductos();
    document.getElementById("descuento_valor").value = 0;
    document.getElementById("cantidad").value = 1;
    document.getElementById("cliente_id").value = "";
    document.getElementById("producto_id").value = "";
    actualizarResumen(0, 0, 0, 0);
  } else {
    alertaError("Error al guardar venta");
  }
}
