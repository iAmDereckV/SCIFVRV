<?php
class Security
{
    public static function hashPassword($password)
    {
        return password_hash(
            $password,
            PASSWORD_DEFAULT
        );
    }
    public static function verifyPassword($password, $hash)
    {
        return password_verify(
            $password,
            $hash
        );
    }
    public static function limpiar($texto)
    {
        return htmlspecialchars(
            trim($texto),
            ENT_QUOTES,
            'UTF-8'
        );
    }
}
