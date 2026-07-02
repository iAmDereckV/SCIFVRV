<h2>Backup y Restauración</h2>

<div class="card mb-3">
    <div class="card-header">
        Respaldos
    </div>

    <div class="card-body">


        <button class="btn btn-success mb-2" onclick="backupCompleto()">

            Exportar Completo (SQL + Imágenes)

        </button>
        <br>

        <button class="btn btn-primary mb-2" onclick="generarBackup()">

            Generar Backup

        </button>



    </div>
</div>

<div class="card mb-3">

    <div class="card-header">
        Restaurar Base de Datos
    </div>

    <div class="card-body">

        <input type="file" id="archivo_sql" class="form-control mb-2" accept=".sql">

        <button class="btn btn-warning" onclick="restaurarSQL()">

            Restaurar SQL

        </button>

    </div>

</div>

<div class="card mb-3">

    <div class="card-header">
        Restaurar Archivos
    </div>

    <div class="card-body">

        <input type="file" id="archivo_zip" class="form-control mb-2" accept=".zip">

        <button class="btn btn-secondary" onclick="restaurarArchivos()">

            Restaurar Archivos

        </button>

    </div>

</div>

<div class="card border-danger">

    <div class="card-header bg-danger text-white">

        Zona de Riesgo

    </div>

    <div class="card-body">

        <button class="btn btn-danger" onclick="reiniciarSistema()">

            Reiniciar Sistema

        </button>

    </div>

</div>
<hr>

<h3>Historial de Respaldos</h3>

<table class="table" id="tablaRespaldos">

    <thead>

        <tr>

            <th>ID</th>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Archivo</th>
            <th>Acciones</th>

        </tr>

    </thead>

    <tbody>

    </tbody>

</table>
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