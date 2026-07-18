<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="login-page">
    <div class="card login-card">
        <div class="login-header">
            <img class="login-logo" src="uploads/empresa/logo_empresa.png" onerror="
                if(this.src.includes('.png')){
                    this.src='uploads/empresa/logo_empresa.jpg';
                }else if(this.src.includes('.jpg')){
                    this.src='uploads/empresa/logo_empresa.jpeg';
                }else{
                    this.src='assets/img/sin-imagen.png';
                }
            ">
            <h3 class="mb-1">Sistema de Inventario</h3>
            <small>Control de Inventario y Facturación</small>
        </div>
        <div class="login-body">
            <form id="formLogin">
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <button class="btn btn-primary w-100 btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Ingresar
                </button>
            </form>
            <div class="login-footer">© <?= date('Y') ?></div>
        </div>
    </div>
    <script>
    document
        .getElementById("formLogin")
        .addEventListener("submit", async function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let response = await fetch("../api/auth/login.php", {
                method: "POST",
                body: formData,
            });
            let data = await response.json();
            if (data.success) {
                window.location = "index.php";
            } else {
                alert(data.mensaje);
            }
        });
    </script>
</body>

</html>