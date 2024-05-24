<?php

declare(strict_types = 1);

namespace App\Lib\Oauth;

use App\Lib\Consts\UserGroups;
use RestApi\Lib\Helpers\OauthBaseServer;
use RestApi\Model\Table\OauthAccessTokensTable;

class OAuthServer extends OauthBaseServer
{
    protected function loadStorage(): OauthAccessTokensTable
    {
        return OauthAccessTokensTable::load();
    }

    protected function managerGroups(): array
    {
        return [UserGroups::ADMIN, UserGroups::MODERATOR];
    }

    public function isSellerUser(): bool
    {
        return $this->getUserGroup() == UserGroups::SELLER;
    }

    public function isSmeUser(): bool
    {
        return $this->isSellerUser();// && $this->getAccessLevel() == AccessLevel::SME;
    }

    public function isTrainerUser(): bool
    {
        return $this->getUserGroup() == UserGroups::TRAINER;
    }
}
