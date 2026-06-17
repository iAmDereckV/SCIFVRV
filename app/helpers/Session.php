<?php

class Session
{
    public static function iniciar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function existe($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function eliminar($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destruir()
    {
        session_destroy();
    }
}
