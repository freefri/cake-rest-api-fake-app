<?php

declare(strict_types = 1);

namespace App\Lib\I18n;

use Cake\I18n\I18n;

class LegacyI18n extends I18n
{
    public static function setDefaultLocale()
    {
        $defaultLang = env('DEFAULT_LANGUAGE');
        if ($defaultLang) {
            parent::setLocale($defaultLang);
        } else {
            parent::setLocale(\App\Lib\Consts\LanguagesISO6393::ENG);
        }
    }
}
