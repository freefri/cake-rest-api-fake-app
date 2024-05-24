<?php

namespace App\Lib;

class FullBaseUrl
{
    public static function host(): string
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            if (strpos($_SERVER['HTTP_HOST'], 'dev') === 0) {
                $scheme = 'http://';
            } else {
                $scheme = 'https://';
            }
            return $scheme . $_SERVER['HTTP_HOST'];
        }
        return 'http://command.or.test.example.com';
    }
}
