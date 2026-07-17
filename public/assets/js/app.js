(function () {
  "use strict";
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]'),
  );
  tooltipTriggerList.forEach(function (tooltipTriggerEl) {
    new bootstrap.Tooltip(tooltipTriggerEl);
  });
})();
(async function () {
  let response = await fetch(IRL + "/api/configuracion_empresa/obtener.php");

  let data = await response.json();

  if (!data) return;
  document.getElementById("navtitle").textContent = data.nombre_empresa ?? "";
  document.getElementById("navslogan").innerText = data.slogan ?? "";
  if (data.logo) {
    let img = document.getElementById("navlogo");

    img.src = IRL + "/public/uploads/empresa/" + data.logo;
  }
})();
document.addEventListener("DOMContentLoaded", () => {
  const botonOpen = document.getElementById("btnMenuOpen");
  const botonClose = document.getElementById("btnMenuClose");

  const sidebar = document.getElementById("sidebar");

  if (botonOpen) {
    botonOpen.addEventListener("click", () => {
      sidebar.classList.add("show");
    });
  }
  if (botonClose) {
    botonClose.addEventListener("click", () => {
      sidebar.classList.remove("show");
    });
  }
});
