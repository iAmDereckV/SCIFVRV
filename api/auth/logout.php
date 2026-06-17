<?php


require_once __DIR__ . '/../../app/controllers/AuthController.php';

$auth = new AuthController();

$auth->logout();

header('Location: ./../../public/login.php');
exit;
