<?php
$lock = __DIR__ . '/storage/installed.lock';

if (!file_exists($lock)) {
    header('Location: database/instalar.php');
    exit;
}

header('Location: public/index.php');
exit;