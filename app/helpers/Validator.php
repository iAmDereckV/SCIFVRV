<?php

class Validator
{
    public static function requerido($valor)
    {
        return !empty(trim($valor));
    }

    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function numero($valor)
    {
        return is_numeric($valor);
    }
}