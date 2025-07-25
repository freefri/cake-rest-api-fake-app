<?php

declare(strict_types = 1);

namespace App\Test\Fixture;

use RestApi\TestSuite\Fixture\RestApiFixture;

class OauthAccessTokensFixture extends RestApiFixture
{
    const LOAD = 'app.OauthAccessTokens';
    const ACCESS_TOKEN_SELLER = '555ca191ca768883333c916a0c05bc72bdbbc89';
    const ACCESS_TOKEN_BUYER = '523ca191ca768883592c916a0c05bc72bdbbc936';
    const ACCESS_TOKEN_ADMIN = '777ca191ca768883592c916a0c05bc72bdbbc936';

    public string $table = 'oauth_access_tokens';
    public array $records = [];

    public function __construct()
    {
        $nextYear = ((int)date('Y')) + 1;
        $this->records[] = [
            'access_token' => '253ca191ca768883592c916a0c05bc72bdbbc936',
            'client_id' => '54',
            'user_id' => '54',
            'expires' => $nextYear . '-05-20 17:20:05',
            'scope' => null,
        ];
        $this->records[] = [
            'access_token' => self::ACCESS_TOKEN_SELLER,
            'client_id' => '54',
            'user_id' => UsersFixture::SELLER_ID,
            'expires' => ($nextYear) . '-05-20 17:20:05',
            'scope' => null,
        ];
        $this->records[] = [
            'access_token' => self::ACCESS_TOKEN_BUYER,
            'client_id' => '54',
            'user_id' => UsersFixture::BUYER_ID,
            'expires' => ($nextYear) . '-05-20 17:20:05',
            'scope' => null,
        ];
        $this->records[] = [
            'access_token' => self::ACCESS_TOKEN_ADMIN,
            'client_id' => '54',
            'user_id' => UsersFixture::ADMIN_ID,
            'expires' => ($nextYear) . '-05-20 17:20:05',
            'scope' => null,
        ];
        parent::__construct();
    }
}
