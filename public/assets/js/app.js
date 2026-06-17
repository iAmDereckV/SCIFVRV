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
  if (data.logo) {
    let img = document.getElementById("navlogo");

    img.src = IRL + "/public/uploads/empresa/" + data.logo;
    img.style.display = "block";
  }
})();
