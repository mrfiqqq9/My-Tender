<?php
declare(strict_types=1);

namespace App;

use Cake\Core\Configure;
use Cake\Http\BaseApplication;
use Cake\Http\MiddlewareQueue;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Error\Middleware\ErrorHandlerMiddleware;

class Application extends BaseApplication
{
    /**
     * Bootstrap any application services.
     */
    public function bootstrap(): void
    {
        parent::bootstrap();
    }

    /**
     * Setup middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // 🔥 ERROR HANDLER (CakePHP 5 way)
            ->add(new ErrorHandlerMiddleware())

            // Static assets
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Routing
            ->add(new RoutingMiddleware($this))

            // Body parser (JSON, form-data)
            ->add(new BodyParserMiddleware())

            // CSRF (subfolder safe)
          ->add(new CsrfProtectionMiddleware([
            'httponly' => true,
            'secure' => false,
            'path' => '/my-tender', // ⬅️ INI WAJIB
            ]));

        
        return $middlewareQueue;
    }
}
