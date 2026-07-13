<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">

    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="#">

            <i class="bi bi-speedometer2 fs-3 me-2 text-warning"></i>

            <div>

                <h5 class="mb-0 fw-bold" id="navtitle"></h5>

                <small class="text-light opacity-75">
                    Sistema de Inventario
                </small>

            </div>

        </a>

        <div class="d-flex align-items-center">

            <div class="text-end me-3">

                <div class="fw-bold text-white">

                    <?= $_SESSION['nombre'] ?>

                </div>

                <small class="text-light opacity-75">

                    <?= $_SESSION['rol_nombre'] ?>

                </small>

            </div>

            <img src="<?= $_SESSION['ufoto'] ? 'uploads/usuarios/' . $_SESSION['ufoto'] : 'assets/img/sin-imagen.png' ?>"
                class="rounded-circle border border-2 border-warning shadow-sm me-3" width="55" height="55"
                style="object-fit:cover;">

            <a href="./../api/auth/logout.php" class="btn btn-outline-light">

                <i class="bi bi-box-arrow-right me-1"></i>

                Salir

            </a>

        </div>

    </div>

</nav>