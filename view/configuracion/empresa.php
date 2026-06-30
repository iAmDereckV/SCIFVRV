<?= tienePermiso('empresa_configurar') ? '' : header("Location: index.php"); ?>
<h2>

    Configuración Empresa

</h2>

<form id="formEmpresa">

    <input type="text" id="nombre_empresa" class="form-control mb-2" placeholder="Nombre Empresa">

    <input type="text" id="ruc" class="form-control mb-2" placeholder="RUC">

    <input type="text" id="telefono" class="form-control mb-2" placeholder="Teléfono">

    <input type="email" id="correo" class="form-control mb-2" placeholder="Correo">

    <textarea id="direccion" class="form-control mb-2" placeholder="Dirección">
    </textarea>

    <div class="mb-3">

        <label>Logo</label>

        <input type="file" id="logo" class="form-control">

    </div>

    <div class="mb-3">

        <img id="previewLogo" src="" width="150" style="display:none;">

    </div>
    <input type="text" id="slogan" class="form-control mb-2" placeholder="Slogan">
    <button class="btn btn-primary" type="submit">

        Guardar

    </button>

</form>
<script>
    const PUEDE_EDITAR_EMPRESA =
        <?= tienePermiso('empresa_configurar')
            ? 'true'
            : 'false' ?>;
</script>
<script src="assets/js/configuracion_empresa.js"></script>