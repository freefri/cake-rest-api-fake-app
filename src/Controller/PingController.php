<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Lib\I18n\LegacyI18n;
use Cake\Http\Exception\BadRequestException;
use Cake\I18n\FrozenTime;
use RestApi\Controller\RestApiController;

class PingController extends RestApiController
{
    private const SECRET = 'pong';

    public function isPublicController(): bool
    {
        return true;
    }

    protected function getData($id)
    {
        if ($id != self::SECRET) {
            throw new BadRequestException('Invalid ping');
        }
        $toRet = [
            '0' => LegacyI18n::getLocale(),
            '1' => env('HTTP_HOST', ''),
            '2' => env('APPLICATION_ENV', ''),
            '4' => new FrozenTime(),
            '5' => env('TEST_ENV', ''),
            '6' => env('TAG_VERSION', ''),
        ];

        $this->return = $toRet;
    }
}
