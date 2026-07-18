document.addEventListener("DOMContentLoaded", () => {
  cargarRespaldos();
});

async function cargarRespaldos() {
  let response = await fetch(IRL + "/api/backup/listar.php");
  let data = await response.json();
  let html = "";
  data.forEach((respaldo) => {
    html += `
<tr>
  <td>${respaldo.id}</td>
  <td>${respaldo.fecha}</td>
  <td>${respaldo.usuario}</td>
  <td>${respaldo.archivo}</td>
  <td>
    <div class="btn-group">
      <button
        class="btn btn-sm btn-outline-success"
        title="Descargar"
        onclick="descargarBackup('${respaldo.archivo}')"
      >
        <i class="bi bi-download"></i>
      </button>
      <button
        class="btn btn-sm btn-outline-danger"
        title="Eliminar"
        onclick="eliminarRespaldo(${respaldo.id})"
      >
        <i class="bi bi-trash3"></i>
      </button>
    </div>
  </td>
</tr>
`;
  });
  document.querySelector("#tablaRespaldos tbody").innerHTML = html;
}

function generarBackup() {
  if (!PUEDE_GENRERAR_BACKUP) {
    alert("No tiene permiso para generar backup");
    return;
  }
  window.location.href = IRL + "/api/backup/exportar_sql.php";
  setTimeout(() => {
    cargarRespaldos();
  }, 1000);
}

async function backupCompleto() {
  if (!PUEDE_GENRERAR_BACKUP) {
    alert("No tiene permiso para generar backup");
    return;
  }
  window.location.href = IRL + "/api/backup/exportar_zip.php";
}

async function descargarBackup(nombre) {
  if (!PUEDE_GENRERAR_BACKUP) {
    alert("No tiene permiso para generar backup");
    return;
  }
  window.location.href = `${IRL}/api/backup/descargar.php?archivo=${nombre}`;
}

async function restaurarSQL() {
  if (!PUEDE_RESTAURAR_BACKUP) {
    alert("No tiene permiso para restaurar backup");
    return;
  }
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
  if (!PUEDE_RESTAURAR_BACKUP) {
    alert("No tiene permiso para restaurar backup");
    return;
  }
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

async function reiniciarSistema() {
  if (!PUEDE_REINICIAR_EMPRESA) {
    alert("No tiene permiso para reiniciar datos");
    return;
  }
  if (!confirm("Se eliminarán todos los datos. ¿Desea continuar?")) {
    return;
  }
  let response = await fetch(IRL + "/api/backup/reiniciar.php");
  let data = await response.json();
  if (data.success) {
    alert("Sistema reiniciado");
  } else {
    alert("Error al reiniciar");
  }
}

async function eliminarRespaldo(id) {
  if (!PUEDE_ELIMINAR_BACKUP) {
    alert("No tiene permiso para eliminar backup");
    return;
  }
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
  } else {
    alert("Error al respaldar");
  }
}
