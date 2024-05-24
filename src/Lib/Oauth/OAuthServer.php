<?php

declare(strict_types = 1);

namespace App\Lib\Oauth;

use RestApi\Lib\Helpers\OauthBaseServer;
use RestApi\Model\Table\OauthAccessTokensTable;

class OAuthServer extends OauthBaseServer
{
    private const GROUP_ADMIN = 1;
    protected function loadStorage(): OauthAccessTokensTable
    {
        return OauthAccessTokensTable::load();
    }

    protected function managerGroups(): array
    {
        return [self::GROUP_ADMIN];
    }
}
