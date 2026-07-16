<div class="container-fluid">

    <h3 class="page-title mb-4">
        <i class="bi bi-building-fill-gear text-primary"></i>
        Configuración de la Empresa
    </h3>

    <form id="formEmpresa">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-building text-primary"></i>

                    Datos Generales

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Datos -->

                    <div class="col-lg-8">

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label">

                                    Nombre Empresa

                                </label>

                                <input
                                    type="text"
                                    id="nombre_empresa"
                                    class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    RUC

                                </label>

                                <input
                                    type="text"
                                    id="ruc"
                                    class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Teléfono

                                </label>

                                <input
                                    type="text"
                                    id="telefono"
                                    class="form-control">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Correo

                                </label>

                                <input
                                    type="email"
                                    id="correo"
                                    class="form-control">

                            </div>

                            <div class="col-md-12">

                                <label class="form-label">

                                    Dirección

                                </label>

                                <textarea
                                    id="direccion"
                                    rows="3"
                                    class="form-control"></textarea>

                            </div>

                            <div class="col-md-12">

                                <label class="form-label">

                                    Slogan

                                </label>

                                <input
                                    type="text"
                                    id="slogan"
                                    class="form-control">

                            </div>

                        </div>

                    </div>

                    <!-- Logo -->

                    <div class="col-lg-4">

                        <div class="card border shadow-sm h-100">

                            <div class="card-header bg-light text-center">

                                <strong>

                                    Logo Empresa

                                </strong>

                            </div>

                            <div class="card-body text-center">

                                <img
                                    id="previewLogo"
                                    src=""
                                    class="img-fluid rounded border mb-3"
                                    style="max-height:220px; display:none;">

                                <input
                                    type="file"
                                    id="logo"
                                    class="form-control">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card-footer bg-white text-end">

                <button
                    type="reset"
                    class="btn btn-outline-secondary">

                    <i class="bi bi-arrow-clockwise"></i>

                    Limpiar

                </button>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-check-circle"></i>

                    Guardar Configuración

                </button>

            </div>

        </div>

    </form>

</div>

<script>
    const PUEDE_EDITAR_EMPRESA =
        <?= tienePermiso('empresa_configurar') ? 'true' : 'false' ?>;
</script>

<script src="assets/js/configuracion_empresa.js"></script>