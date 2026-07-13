document.addEventListener("DOMContentLoaded", () => {
  cargarResumen();
  cargarVentasMes();
  cargarProductosVendidos();
  cargarStockBajo();
  cargarVentasVendedor();
  cargarResumenFinanciero();
  cargarActividadReciente();
  cargarStockBajoTabla();
  cargarUltimasVentas();
  cargarUltimasCompras();
});
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

async function cargarVentasMes() {
  let response = await fetch(IRL + "/api/dashboard/ventas_mes.php");

  let data = await response.json();

  let labels = [];
  let ventas = [];
  let compras = [];

  data.forEach((item) => {
    labels.push(item.mes);

    ventas.push(item.ventas);

    compras.push(item.compras);
  });

  new Chart(document.getElementById("graficoVentas"), {
    type: "bar",

    data: {
      labels: labels,

      datasets: [
        {
          label: "Ventas",
          data: ventas,
          borderRadius: 8,
          borderSkipped: false,
        },

        {
          label: "Compras",
          data: compras,
          borderRadius: 8,
          borderSkipped: false,
        },
      ],
    },
    options: {
      responsive: true,

      plugins: {
        legend: {
          position: "bottom",
        },
      },

      scales: {
        y: {
          beginAtZero: true,
        },
      },
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
    type: "doughnut",

    data: {
      labels: labels,

      datasets: [
        {
          label: "Cantidad vendida",

          data: valores,
          data: valores,
          borderWidth: 2,
        },
      ],
    },

    options: {
      indexAxis: "y",
      plugins: {
        legend: {
          position: "bottom",
        },
      },
      backgroundColor: [
        "#20c997",
        "#ffc107",
        "#dc3545",
        "#6610f2",
        "#fd7e14",
        "#198754",
        "#6f42c1",
        "#0dcaf0",
        "#6c757d",
        "#0d6efd",
      ],
      animation: {
        duration: 1800,
        easing: "easeOutQuart",
      },
      responsive: true,
      cutout: "55%",
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
    type: "bar",
    data: {
      labels: labels,

      datasets: [
        {
          label: "Stock disponible",

          data: valores,

          borderRadius: 8,
          borderSkipped: false,
        },
      ],
    },
    options: {
      backgroundColor: "#dc3545",
      indexAxis: "y",
      responsive: true,

      plugins: {
        legend: {
          display: false,
        },
      },
    },
  });
}
async function cargarVentasVendedor() {
  let response = await fetch(IRL + "/api/dashboard/ventas_vendedor.php");

  let data = await response.json();

  let labels = [];
  let valores = [];

  data.forEach((item) => {
    labels.push(item.nombre);
    valores.push(item.total);
  });

  new Chart(document.getElementById("graficoVendedores"), {
    type: "polarArea",

    data: {
      labels,

      datasets: [
        {
          data: valores,

          borderWidth: 2,
        },
      ],
    },

    options: {
      backgroundColor: [
        "#0d6efd",
        "#20c997",
        "#ffc107",
        "#dc3545",
        "#6610f2",
        "#fd7e14",
        "#198754",
        "#6f42c1",
        "#0dcaf0",
        "#6c757d",
      ],
      responsive: true,
      animation: {
        duration: 1800,
        easing: "easeOutQuart",
      },
      cutout: "60%",

      plugins: {
        legend: {
          position: "bottom",
        },
      },
    },
  });
}
async function cargarResumenFinanciero() {
  let response = await fetch(IRL + "/api/dashboard/resumen_financiero.php");

  let data = await response.json();
  console.log(data);
  document.getElementById("rfVentas").innerText =
    "C$ " + Number(data.ventas).toFixed(2);

  document.getElementById("rfCostos").innerText =
    "C$ " + Number(data.costos).toFixed(2);

  document.getElementById("rfGastos").innerText =
    "C$ " + Number(data.gastos).toFixed(2);

  document.getElementById("rfUtilidad").innerText =
    "C$ " + Number(data.utilidad).toFixed(2);
}
async function cargarActividadReciente() {
  let response = await fetch(
    IRL + "/api/dashboard/tabla_actividad_reciente.php",
  );
  let data = await response.json();
  let html = "";
  data.forEach((usuario) => {
    html += `
        <tr>
           <td>${usuario.nombre}</td>
            <td>${usuario.usuario}</td>
            <td>${usuario.ultimo_acceso}</td>
        </tr>
        `;
  });
  document.getElementById("tablaActividad").innerHTML = html;
}
async function cargarStockBajoTabla() {
  let response = await fetch(IRL + "/api/dashboard/tabla_stock_bajo.php");

  let data = await response.json();

  let html = "";

  data.forEach((producto) => {
    html += `

        <tr>

            <td>${producto.nombre}</td>

            <td>

                <span class="badge bg-danger">

                    ${producto.stock}

                </span>

            </td>

            <td>${producto.stock_minimo}</td>

        </tr>

        `;
  });

  document.getElementById("tablaStockBajo").innerHTML = html;
}
async function cargarUltimasVentas() {
  let response = await fetch(IRL + "/api/dashboard/tabla_ultimas_ventas.php");

  let data = await response.json();

  let html = "";

  data.forEach((venta) => {
    html += `

        <tr>

            <td>#${venta.id}</td>

            <td>${venta.cliente}</td>

            <td class="text-success">

                C$ ${Number(venta.total).toFixed(2)}

            </td>

        </tr>

        `;
  });

  document.getElementById("tablaUltimasVentas").innerHTML = html;
}
async function cargarUltimasCompras() {
  let response = await fetch(IRL + "/api/dashboard/tabla_ultimas_compra.php");

  let data = await response.json();

  let html = "";

  data.forEach((compra) => {
    html += `

        <tr>

            <td>#${compra.id}</td>

            <td>${compra.proveedor}</td>

            <td class="text-primary">

                C$ ${Number(compra.total).toFixed(2)}

            </td>

        </tr>

        `;
  });

  document.getElementById("tablaUltimasCompras").innerHTML = html;
}
