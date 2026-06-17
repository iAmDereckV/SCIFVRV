<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        Iniciar Sesión
                    </div>
                    <div class="card-body">
                        <form id="formLogin">
                            <div class="mb-3">
                                <label>Usuario</label>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                Ingresar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    console.log('../api/auth/login.php')
    document.getElementById('formLogin')
        .addEventListener('submit', async function(e) {

            e.preventDefault();
            let formData = new FormData(this);
            let response = await fetch(
                '../api/auth/login.php', {
                    method: 'POST',
                    body: formData
                }
            );

            let data = await response.json();

            if (data.success) {
                window.location.href =
                    'index.php ';
            } else {
                alert(data.mensaje);
            }

        });
    </script>
</body>

</html>