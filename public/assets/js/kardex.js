document.addEventListener("DOMContentLoaded", () => {
  cargarProductos();
});
async function cargarProductos() {
  let response = await fetch(IRL + "/api/kardex/productos.php");
  let data = await response.json();
  let html = '<option value="">Seleccione</option>';
  data.forEach((producto) => {
    html += `
      <option value="${producto.id}">
        ${producto.nombre}
      </option>
    `;
  });
  document.getElementById("producto_id").innerHTML = html;
}
async function consultarKardex() {
  if ($.fn.DataTable.isDataTable("#tablaKardex")) {
    $("#tablaKardex").DataTable().destroy();
  }
  let producto_id = document.getElementById("producto_id").value;
  if (!producto_id) {
    alertaWarning("Seleccione un producto");
    return;
  }
  let response = await fetch(
    IRL + "/api/kardex/consultar.php?producto_id=" + producto_id,
  );
  let data = await response.json();
  let html = "";
  let saldo = 0;
  let producto = await fetch(
    IRL + "/api/kardex/obtener_producto.php?id=" + producto_id,
  );
  producto = await producto.json();
  document.getElementById("infoProducto").style.display = "flex";
  document.getElementById("nombreProducto").innerText = producto.nombre;
  document.getElementById("codigoProducto").innerText = producto.codigo;
  document.getElementById("stockProducto").innerText = producto.stock;
  const stock = document.getElementById("stockProducto");
  stock.innerText = producto.stock;
  if (parseInt(producto.stock) <= 0) {
    stock.className = "text-danger fw-bold";
  } else if (parseInt(producto.stock) <= producto.stock_minimo) {
    stock.className = "text-warning fw-bold";
  } else {
    stock.className = "text-success fw-bold";
  }
  document.getElementById("fotoProducto").src = producto.imagen
    ? IRL + "/public/uploads/productos/" + producto.imagen
    : IRL + "/public/assets/img/sin-imagen.png";
  const estado = document.getElementById("estadoProducto");
  if (producto.estado === "ACTIVO") {
    estado.innerHTML =
      '<span class="badge bg-success px-3 py-2">Disponible</span>';
  } else {
    estado.innerHTML =
      '<span class="badge bg-warning px-3 py-2">Inactivo</span>';
  }
  if (parseInt(producto.stock) <= 0) {
    estado.innerHTML =
      '<span class="badge bg-danger px-3 py-2">Sin stock</span>';
  }
  data.forEach((movimiento) => {
    if (movimiento.tipo === "COMPRA") {
      saldo += parseInt(movimiento.cantidad);
    } else {
      saldo -= parseInt(movimiento.cantidad);
    }
    html += `
      <tr>
        <td>${movimiento.fecha}</td>
        <td>${movimiento.tipo}</td>
        <td>${movimiento.cantidad}</td>
        <td>${movimiento.detalle}</td>
        <td>${saldo}</td>
      </tr>
    `;
  });
  document.querySelector("#tablaKardex tbody").innerHTML = html;
  $("#tablaKardex").DataTable({
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
    lengthMenu: [
      [5, 10, 25, 50, -1],
      [5, 10, 25, 50, "Todos"],
    ],
    order: [[2, "asc"]],
  });
}
