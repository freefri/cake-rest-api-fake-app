<?php

declare(strict_types = 1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Http\Exception\BadRequestException;

class OAuthServerComponent extends BaseOAuthServerComponent
{
    public function isManagerUser(): bool
    {
        return $this->server->isManagerUser();
    }

    public function isSmeUser(): bool
    {
        return $this->server->isSmeUser();
    }
}
