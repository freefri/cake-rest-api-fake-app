<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Controller\Component\OAuthServerComponent;
use Cake\Controller\Component;
use RestApi\Controller\Component\ApiRestCorsComponent;
use RestApi\Controller\RestApiController;

class ApiController extends RestApiController
{
    protected function _loadCorsComponent(): ApiRestCorsComponent
    {
        return ApiRestCorsComponent::load($this);
    }

    protected function _loadOAuthServerComponent(): Component
    {
        $this->loadComponentFromClass(OAuthServerComponent::class);
        return $this->OAuthServer;
    }

    protected function _setUserLang(): void
    {
        // TODO: Implement _setUserLang() method.
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
