<?php

require_once '../../app/helpers/Session.php';

Session::iniciar();

echo json_encode([
    'usuario_id' => Session::get('usuario_id')
]);