<nav class="navbar navbar-dark bg-dark">

    <div class="container-fluid">

        <span class="navbar-brand">

            <h1 id="navtitle"></h1>

        </span>

        <div>

            <?= $_SESSION['nombre'] ?>
            <img src="<?= $_SESSION['ufoto'] ? 'uploads/usuarios/' . $_SESSION['ufoto'] : 'assets/img/sin-imagen.png' ?> "
                width=" 80" class="rounded-circle me-2">

            <a class="btn btn-danger btn-sm" href="./../api/auth/logout.php">

                Cerrar sesión

            </a>


        </div>

    </div>

</nav>