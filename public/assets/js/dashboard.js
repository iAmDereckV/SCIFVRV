document.addEventListener("DOMContentLoaded", cargarResumen);

async function cargarResumen() {
  let response = await fetch(IRL + "/api/dashboard/resumen.php");

  let data = await response.json();
  document.getElementById("ventasHoy").innerText =
    "C$ " + Number(data.ventas_hoy).toFixed(2);

  document.getElementById("ventasMes").innerText =
    "C$ " + Number(data.ventas_mes).toFixed(2);

  document.getElementById("compras_mes").innerText =
    "C$ " + Number(data.compras_mes).toFixed(2);

  document.getElementById("utilidadMes").innerText =
    "C$ " + Number(data.utilidad).toFixed(2);

  document.getElementById("productos").innerText = data.productos;

  document.getElementById("clientes").innerText = data.clientes;

  document.getElementById("facturas").innerText = data.facturas;
  document.getElementById("stock_bajo").innerText = data.stock_bajo;
}
document.addEventListener("DOMContentLoaded", () => {
  cargarResumen();
  cargarVentasMes();
  cargarProductosVendidos();
  cargarStockBajo();
});
async function cargarVentasMes() {
  let response = await fetch(IRL + "/api/dashboard/ventas_mes.php");

  let data = await response.json();

  let labels = [];
  let valores = [];

  data.forEach((item) => {
    labels.push(item.mes);
    valores.push(item.total);
  });

  new Chart(document.getElementById("graficoVentas"), {
    type: "bar",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Ventas",
          data: valores,
        },
      ],
    },
  });
}
async function cargarProductosVendidos() {
  let response = await fetch(IRL + "/api/dashboard/productos_vendidos.php");

  let data = await response.json();

  let labels = [];
  let valores = [];

  data.forEach((item) => {
    labels.push(item.nombre);
    valores.push(item.cantidad);
  });

  new Chart(document.getElementById("graficoProductos"), {
    type: "pie",
    data: {
      labels: labels,
      datasets: [
        {
          data: valores,
        },
      ],
    },
  });
}
async function cargarStockBajo() {
  let response = await fetch(IRL + "/api/dashboard/stock_bajo.php");

  let data = await response.json();

  let labels = [];
  let valores = [];

  data.forEach((item) => {
    labels.push(item.nombre);
    valores.push(item.stock);
  });

  new Chart(document.getElementById("graficoStock"), {
    type: "line",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Stock",
          data: valores,
        },
      ],
    },
  });
}
