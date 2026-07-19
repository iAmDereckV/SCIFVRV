let detalleCompra = [];
let totalCompra = 0;
document.addEventListener("DOMContentLoaded", () => {
  cargarProveedores();
  cargarProductos();
});
async function cargarProveedores() {
  let response = await fetch(IRL + "/api/compras/proveedores.php");
  let data = await response.json();
  let html = '<option value="">Seleccione</option>';
  data.forEach((proveedor) => {
    html += `
      <option value="${proveedor.id}">
        ${proveedor.nombre}
      </option>
    `;
  });
  document.getElementById("proveedor_id").innerHTML = html;
}

async function cargarProductos() {
  let response = await fetch(IRL + "/api/compras/productos.php");
  let data = await response.json();
  let html = '<option value="">Seleccione</option>';
  data.forEach((producto) => {
    html += `
      <option
        value="${producto.id}"
        data-nombre="${producto.nombre}"
      >
        ${producto.nombre}
      </option>
    `;
  });
  document.getElementById("producto_id").innerHTML = html;
}

function agregarProducto() {
  let producto = document.getElementById("producto_id");
  let producto_id = producto.value;
  if (!producto_id) {
    alert("Seleccione producto");
    return;
  }
  let existente = detalleCompra.find((item) => item.producto_id == producto_id);
  let nombre = producto.options[producto.selectedIndex].dataset.nombre;
  let cantidad = parseInt(document.getElementById("cantidad").value);
  let costo = parseFloat(document.getElementById("costo").value);
  if (existente) {
    if (confirm("Este producto ya está agregado.\n¿Desea sumar la cantidad?")) {
      existente.cantidad += cantidad;
      existente.costo = costo;
      existente.subtotal = existente.cantidad * existente.costo;
      renderDetalle();
    }
    return;
  }
  if (!cantidad || cantidad <= 0) {
    alert("Cantidad inválida");
    return;
  }
  if (!costo || costo <= 0) {
    alert("Costo inválido");
    return;
  }
  let subtotal = cantidad * costo;
  detalleCompra.push({
    producto_id,
    nombre,
    cantidad,
    costo,
    subtotal,
  });
  renderDetalle();
  document.getElementById("producto_id").value = "";
  document.getElementById("cantidad").value = "";
  document.getElementById("costo").value = "";
}

function eliminarProducto(index) {
  detalleCompra.splice(index, 1);
  renderDetalle();
}

function renderDetalle() {
  let html = "";
  let total = 0;
  let unidades = 0;
  detalleCompra.forEach((item, index) => {
    total += Number(item.subtotal);
    unidades += Number(item.cantidad);
    html += `
      <tr>
        <td>${item.nombre}</td>
        <td>${item.cantidad}</td>
        <td>C$ ${item.costo}</td>
        <td>C$ ${item.subtotal.toFixed(2)}</td>
        <td>
          <button
            class="btn btn-danger btn-sm"
            onclick="eliminarProducto(${index})">X
            </button>
        </td>
      </tr>
      `;
  });
  document.getElementById("cantidadProductos").innerText = detalleCompra.length;
  document.getElementById("cantidadUnidades").innerText = unidades;
  totalCompra = total;
  document.getElementById("total").innerText = "C$ " + total.toFixed(2);
  document.querySelector("#tablaDetalle tbody").innerHTML = html;
}

async function guardarCompra() {
  if (!PUEDE_CREAR_COMPRAS) {
    alert("No tiene permiso para realizar ventas");
    return;
  }
  if (detalleCompra.length === 0) {
    alert("Debe agregar productos");
    return;
  }
  let proveedor_id = document.getElementById("proveedor_id").value;
  if (!proveedor_id) {
    alert("Seleccione proveedor");
    return;
  }
  let formData = new FormData();
  formData.append("proveedor_id", proveedor_id);
  formData.append("factura", document.getElementById("factura").value);
  let archivo = document.getElementById("archivo_factura").files[0];
  if (archivo) {
    formData.append("archivo_factura", archivo);
  }
  formData.append("total", totalCompra);
  formData.append("productos", JSON.stringify(detalleCompra));
  let response = await fetch(IRL + "/api/compras/guardar.php", {
    method: "POST",
    body: formData,
  });
  let data = await response.json();
  if (data.success) {
    alert("Compra registrada");
    detalleCompra = [];
    renderDetalle();
    document.getElementById("factura").value = "";
    document.getElementById("proveedor_id").value = "";
    document.getElementById("archivo_factura").value = "";
  } else {
    alert("Error al guardar compra");
  }
}
