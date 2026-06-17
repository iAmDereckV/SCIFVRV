document.addEventListener("DOMContentLoaded", () => {
  cargarConfiguracion();

  document
    .getElementById("formEmpresa")
    .addEventListener("submit", guardarConfiguracion);
});

async function cargarConfiguracion() {
  let response = await fetch(IRL + "/api/configuracion_empresa/obtener.php");

  let data = await response.json();

  if (!data) return;

  document.getElementById("nombre_empresa").value = data.nombre_empresa ?? "";

  document.getElementById("ruc").value = data.ruc ?? "";

  document.getElementById("telefono").value = data.telefono ?? "";

  document.getElementById("correo").value = data.correo ?? "";

  document.getElementById("direccion").value = data.direccion ?? "";

  document.getElementById("slogan").value = data.slogan ?? "";
  if (data.logo) {
    let img = document.getElementById("previewLogo");

    img.src = IRL + "/public/uploads/empresa/" + data.logo;
    img.style.display = "block";
  }
}

async function guardarConfiguracion(e) {
  e.preventDefault();

  let formData = new FormData();

  formData.append("nombre", document.getElementById("nombre_empresa").value);

  formData.append("ruc", document.getElementById("ruc").value);

  formData.append("telefono", document.getElementById("telefono").value);

  formData.append("correo", document.getElementById("correo").value);

  formData.append("direccion", document.getElementById("direccion").value);
  let archivo = document.getElementById("logo").files[0];

  if (archivo) {
    formData.append("logo", archivo);
  }

  formData.append("slogan", document.getElementById("slogan").value);

  let response = await fetch(
    IRL + "/api/configuracion_empresa/actualizar.php",
    {
      method: "POST",
      body: formData,
    },
  );

  let data = await response.json();

  if (data.success) {
    alert("Configuración guardada correctamente");
    location.reload();
  } else {
    alert("Error al guardar la configuración");
  }
}
