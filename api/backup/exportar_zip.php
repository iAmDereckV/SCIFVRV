<?php
require_once '../../app/controllers/BackupController.php';
require_once '../../app/helpers/Permisos.php';
requierePermiso('backup_generar');
$controller = new BackupController();
$controller->exportarZip();