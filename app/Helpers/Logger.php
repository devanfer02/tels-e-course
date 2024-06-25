<?php

namespace App\Helpers;

class Logger
{
    public static function errLog(string $layer, string $message)
    {
        error_log($layer . " : " . $message);
    }
}
