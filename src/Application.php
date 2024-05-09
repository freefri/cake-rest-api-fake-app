<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\RouteBuilder;

class Application extends BaseApplication
{
    public function bootstrap(): void
    {
        if (PHP_SAPI === 'cli') {
            $this->bootstrapCli();
        }

        // Load more plugins here
        $this->addPlugin('Migrations');
        $this->addPlugin(\Profile\ProfilePlugin::class);
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers and render error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error')))
            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime')
            ]))
            ->add(new BodyParserMiddleware([
                'xml' => false,
                'json' => true,
            ]))
            ->add(new RoutingMiddleware($this));

        return $middlewareQueue;
    }

    public function routes(RouteBuilder $routes): void
    {
    }

    protected function bootstrapCli()
    {
        try {
            $this->addPlugin('Bake');
        } catch (MissingPluginException $e) {
            // Do not halt if the plugin is missing
        }

        $this->addPlugin('Migrations');
    }

    public function services(ContainerInterface $container): void
    {
    }
}
