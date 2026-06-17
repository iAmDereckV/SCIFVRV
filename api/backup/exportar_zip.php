<?php

require_once '../../app/controllers/BackupController.php';

$controller =
    new BackupController();

$controller->exportarZip();
