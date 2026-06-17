<?php

require_once '../../app/controllers/AuthController.php';
require_once '../../app/helpers/Response.php';

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$auth = new AuthController();

$resultado = $auth->login($usuario, $password);

Response::json($resultado);
