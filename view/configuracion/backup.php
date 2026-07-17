<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            <i class="bi bi-database-fill-lock text-primary"></i>
            Backup y Restauración
        </h2>

    </div>

    <div class="row">

        <!-- RESPALDOS -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-header card-bg text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-cloud-arrow-up-fill"></i>

                        Respaldos

                    </h5>

                </div>

                <div class="card-body d-grid gap-3">

                    <button
                        class="btn btn-success btn-lg"
                        onclick="generarBackup()">

                        <i class="bi bi-database-fill-add"></i>

                        Generar Backup SQL

                    </button>

                    <button
                        class="btn btn-primary btn-lg"
                        onclick="backupCompleto()">

                        <i class="bi bi-file-earmark-zip-fill"></i>

                        Backup Completo

                    </button>

                </div>

            </div>

        </div>

        <!-- RESTAURAR -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-0 rounded-4 h-100">

                <div class="card-header bg-warning text-dark">

                    <h5 class="mb-0">

                        <i class="bi bi-arrow-clockwise"></i>

                        Restaurar

                    </h5>

                </div>

                <div class="card-body">

                    <label class="form-label">

                        Base de Datos (.sql)

                    </label>

                    <input
                        type="file"
                        id="archivo_sql"
                        class="form-control mb-3"
                        accept=".sql">

                    <button
                        class="btn btn-warning w-100 mb-4"
                        onclick="restaurarSQL()">

                        <i class="bi bi-database-fill-down"></i>

                        Restaurar SQL

                    </button>

                    <label class="form-label">

                        Archivos (.zip)

                    </label>

                    <input
                        type="file"
                        id="archivo_zip"
                        class="form-control mb-3"
                        accept=".zip">

                    <button
                        class="btn btn-secondary w-100"
                        onclick="restaurarArchivos()">

                        <i class="bi bi-file-earmark-zip-fill"></i>

                        Restaurar Archivos

                    </button>

                </div>

            </div>

        </div>

        <!-- ZONA DE RIESGO -->
        <div class="col-lg-4">

            <div class="card shadow-sm border-danger rounded-4 h-100">

                <div class="card-header bg-danger text-white">

                    <h5 class="mb-0">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        Zona de Riesgo

                    </h5>

                </div>

                <div class="card-body d-flex flex-column justify-content-center">

                    <div class="alert alert-danger">

                        Esta acción eliminará permanentemente toda la información registrada.

                    </div>

                    <button
                        class="btn btn-danger btn-lg"
                        onclick="reiniciarSistema()">

                        <i class="bi bi-trash3-fill"></i>

                        Reiniciar Sistema

                    </button>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0 rounded-4 mt-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="bi bi-clock-history text-primary"></i>

                Historial de Respaldos

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-hover table-sm align-middle"
                    id="tablaRespaldos">

                    <thead class="table-light">

                        <tr>

                            <th>ID</th>

                            <th>Fecha</th>

                            <th>Usuario</th>

                            <th>Archivo</th>

                            <th width="170">

                                Acciones

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
<script>
    const PUEDE_GENRERAR_BACKUP =
        <?= tienePermiso('backup_generar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_RESTAURAR_BACKUP =
        <?= tienePermiso(
            'backup_restaurar'
        ) ? 'true' : 'false' ?>;
    const PUEDE_REINICIAR_EMPRESA =
        <?= tienePermiso('backup_reiniciar')
            ? 'true'
            : 'false' ?>;
    const PUEDE_ELIMINAR_BACKUP =
        <?= tienePermiso('backup_eliminar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/backup.js"></script>