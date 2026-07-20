<?php
$lock = __DIR__ . '/../storage/installed.lock';
require_once '../app/helpers/instalador.php';
if (file_exists($lock)) {
    header('Location: ../public/index.php');
    exit;
}
$host = 'localhost';
$port = 3306;
$database = 'scifvrv';
$user = 'root';
$pass = '';
$IRL = 'http://localhost/SCIFVRV';

$instalador = new Instalador();
$instalador->conectar($host, $user, $pass, $port);
$instalador->crearBase($database);
$instalador->seleccionarBase($database);
$instalador->ejecutarSchema();
$instalador->ejecutarSeed();
$instalador->guardarConfiguracion($host, $user, $pass, $database, $IRL, $port);
$instalador->crearLock($database);
$instalador->cerrar();
$instalador->finalizar();