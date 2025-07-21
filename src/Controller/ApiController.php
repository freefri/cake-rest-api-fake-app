<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Controller\Component\OAuthServerComponent;
use App\Lib\I18n\LegacyI18n;
use Cake\Controller\Component;
use RestApi\Controller\Component\ApiRestCorsComponent;
use RestApi\Controller\RestApiController;

/**
 * @property OAuthServerComponent $OAuthServer
 */
class ApiController extends RestApiController
{
    public $OAuthServer;

    protected function _loadCorsComponent(): ApiRestCorsComponent
    {
        return ApiRestCorsComponent::load($this);
    }

    protected function _loadOAuthServerComponent(): Component
    {
        /** @var OAuthServerComponent $OAuthServer */
        $OAuthServer = $this->loadComponentFromClass(OAuthServerComponent::class);
        $this->OAuthServer = $OAuthServer;
        return $this->OAuthServer;
    }

    protected function _setUserLang(): void
    {
        LegacyI18n::setDefaultLocale();
        $lang = $this->getRequest()->getHeader('Accept-Language');
        if ($lang && isset($lang[0]) && $lang[0]) {
            try {
                LegacyI18n::setLocale($lang[0]);
            } catch (\Exception $exception) {
                LegacyI18n::setDefaultLocale();
            }
        }
    }

    protected function _setLanguage(): void
    {
        // TODO: Implement _setLanguage() method.
    }

    protected function getLocalOauth()
    {
        // TODO: Implement getLocalOauth() method.
    }
}
