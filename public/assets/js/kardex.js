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
  let producto_id = document.getElementById("producto_id").value;

  if (!producto_id) {
    alert("Seleccione un producto");

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
  document.getElementById("fotoProducto").src = producto.imagen
    ? IRL + "/public/uploads/productos/" + producto.imagen
    : IRL + "/public/assets/img/sin-imagen.png";
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
}
