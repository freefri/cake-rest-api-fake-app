<?php

declare(strict_types = 1);

namespace App\Controller\Component;

use App\Controller\ApiController;
use App\Lib\Oauth\OAuthServer;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Event\EventInterface;
use Cake\Http\Exception\BadRequestException;

class BaseOAuthServerComponent extends Component
{
    /** @var OAuthServer */
    protected $server;

    private $_skipAuth = false;

    public function __construct(ComponentRegistry $registry, array $config = [])
    {
        parent::__construct($registry, $config);
        $this->server = new OAuthServer($config);
    }

    public function beforeFilter(EventInterface $event): void
    {
        /** @var ApiController $controller */
        $controller = $event->getSubject();
        if ($controller->getRequest()->is('options')) {
            $event->setResult($controller->getResponse());
            return;
        }
        $this->server->setupOauth($controller);
        if (!$this->_skipAuth) {
            $this->server->verifyAuthorization();
            $this->_parseRequestParamIDs($controller);
        }
        if ($controller && $controller->getRequest()->is(['POST', 'PUT', 'PATCH'])) {
            if (!$controller->getRequest()->getData()) {
                throw new BadRequestException('Empty body or invalid Content-Type in HTTP request');
            }
        }
    }

    public function startup(Event $event = null)
    {
        $controller = $event->getSubject();
        if (!$this->_skipAuth) {
            $this->server->authorizeUserData($controller);
        }
    }

    public function getUserID()
    {
        return $this->server->getUserID();
    }

    private function _parseRequestParamIDs(Controller $controller)
    {
        $idName = strtolower(substr($controller->getName(), 0, -1)) . 'ID';
        $idValue = $controller->getRequest()->getParam('pass')[0] ?? null;
        if ($idValue !== null) {
            $req = $controller->getRequest();
            $req->withParam($idName, $idValue);
            $controller->setRequest($req);
        } else {
            if (!$controller->getRequest()->is(['POST', 'GET'])) {
                throw new BadRequestException('HTTP method requires ID');
            }
        }
    }
}
