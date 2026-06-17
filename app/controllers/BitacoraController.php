<?php

require_once __DIR__ . '/../models/Bitacora.php';

class BitacoraController
{
    private $bitacora;

    public function __construct()
    {
        $this->bitacora = new Categoria();
    }

    public function listar()
    {
        return $this->bitacora->listar();
    }
}