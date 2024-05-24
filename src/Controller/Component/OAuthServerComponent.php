<?php

declare(strict_types = 1);

namespace App\Controller\Component;

use Cake\Http\Exception\ForbiddenException;

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

    public function isTrainerUser(): bool
    {
        return $this->server->isTrainerUser();
    }

    public function getUserIdsBySme(string $token, $smeId): array
    {
        return [];
    }

    public function checkUserBelongsToSme($token, $smeId, $userId): bool
    {
        throw new ForbiddenException('This user does not belong to manager');
    }

    public function getTrainerParent()
    {
        return false;
    }
}
