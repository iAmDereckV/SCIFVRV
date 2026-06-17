document.addEventListener("DOMContentLoaded", () => {
  cargarRoles();
});

async function cargarRoles() {
  let response = await fetch(IRL + "/api/roles/listar.php");

  let data = await response.json();

  let html = "";

  data.forEach((rol) => {
    html += `
        <tr>
            <td>${rol.id}</td>
            <td>${rol.nombre}</td>
            <td>${rol.descripcion}</td>
            <td>${rol.estado}</td>
        </tr>
        `;
  });

  document.querySelector("#tablaRoles tbody").innerHTML = html;
}
