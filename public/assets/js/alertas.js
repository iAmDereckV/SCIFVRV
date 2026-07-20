function alertaSuccess(mensaje) {
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Correcto",
    text: mensaje,
    showConfirmButton: false,
    timer: 1600,
  });
}

function alertaError(mensaje) {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: mensaje,
  });
}

function alertaWarning(mensaje) {
  Swal.fire({
    position: "top-end",
    icon: "warning",
    title: "Advertencia",
    text: mensaje,
    showConfirmButton: false,
    timer: 1700,
  });
}
async function confirmar(titulo, texto) {
  const result = await Swal.fire({
    title: titulo,
    text: texto,
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Sí",
    cancelButtonText: "Cancelar",
    confirmButtonColor: "#2E7D32 ",
    cancelButtonColor: "#D32F2F",
  });

  return result.isConfirmed;
}
