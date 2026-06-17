async function reiniciarSistema() {
  if (!confirm("Se eliminarán todos los datos. ¿Desea continuar?")) {
    return;
  }

  let response = await fetch(IRL + "/api/backup/reiniciar.php");

  let data = await response.json();

  if (data.success) {
    alert("Sistema reiniciado");
  }
}
document.addEventListener("DOMContentLoaded", () => {
  cargarRespaldos();
});
async function cargarRespaldos() {
  let response = await fetch(IRL + "/api/backup/listar.php");

  let data = await response.json();
  console.log(data);

  let html = "";
  data.forEach((respaldo) => {
    html += `
      <tr>

        <td>${respaldo.id}</td>

        <td>${respaldo.fecha}</td>

        <td>${respaldo.usuario}</td>

        <td>${respaldo.archivo}</td>
<td>

<a
    href="${IRL}/api/backup/descargar.php?archivo=${respaldo.archivo}"
    class="btn btn-success btn-sm">

    Descargar

</a>

<button
    class="btn btn-danger btn-sm"
    onclick="eliminarRespaldo(${respaldo.id})">

    Eliminar

</button>

</td>

      </tr>
    `;
  });

  document.querySelector("#tablaRespaldos tbody").innerHTML = html;
}
async function eliminarRespaldo(id) {
  if (!confirm("¿Eliminar respaldo?")) {
    return;
  }

  let formData = new FormData();

  formData.append("id", id);

  let response = await fetch(IRL + "/api/backup/eliminar.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    alert("Respaldo eliminado");

    cargarRespaldos();
  }
}
function generarBackup() {
  window.location.href = IRL + "/api/backup/exportar_sql.php";

  setTimeout(() => {
    cargarRespaldos();
  }, 1000);
}
async function backupCompleto() {
  window.location.href = IRL + "/api/backup/exportar_zip.php";
}
async function restaurarSQL() {
  let archivo = document.getElementById("archivo_sql").files[0];

  if (!archivo) {
    alert("Seleccione un archivo SQL");
    return;
  }

  if (!confirm("La base de datos actual será reemplazada. ¿Continuar?")) {
    return;
  }

  let formData = new FormData();

  formData.append("archivo_sql", archivo);

  let response = await fetch(IRL + "/api/backup/restaurar_sql.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    alert("Base de datos restaurada");
    location.reload();
  } else {
    alert(data.mensaje || "Error al restaurar");
  }
}
async function restaurarArchivos() {
  let archivo = document.getElementById("archivo_zip").files[0];

  if (!archivo) {
    alert("Seleccione un ZIP");
    return;
  }

  if (!confirm("Los archivos actuales serán reemplazados. ¿Continuar?")) {
    return;
  }

  let formData = new FormData();

  formData.append("archivo_zip", archivo);

  let response = await fetch(IRL + "/api/backup/restaurar_zip.php", {
    method: "POST",
    body: formData,
  });

  let data = await response.json();

  if (data.success) {
    alert("Archivos restaurados");
    location.reload();
  } else {
    alert("Error al restaurar");
  }
}
