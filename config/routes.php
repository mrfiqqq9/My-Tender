<?php
declare(strict_types=1);

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {

    // Guna dashed-case URL
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/login', ['controller' => 'Auth', 'action' => 'login']);
$builder->connect('/signup', ['controller' => 'Auth', 'action' => 'signup']);
$builder->connect('/logout', ['controller' => 'Auth', 'action' => 'logout']);

$builder->connect('/analytics/admin', ['controller' => 'Analytics', 'action' => 'admin']);
$builder->connect('/analytics/staff', ['controller' => 'Analytics', 'action' => 'staff']);
$builder->connect('/analytics/vendor', ['controller' => 'Analytics', 'action' => 'vendor']);
$builder->connect('/profile', ['controller' => 'Profiles', 'action' => 'index']);


        /**
         * Homepage
         * http://localhost/my-tender/
         */
        $builder->connect('/', [
            'controller' => 'Pages',
            'action' => 'display',
            'home',
        ]);

        /**
         * Vendor – My Applications
         * http://localhost/my-tender/tender-applications/my-applications
         */
        $builder->connect(
            '/tender-applications/my-applications',
            ['controller' => 'TenderApplications', 'action' => 'myApplications']
        );

        /**
         * Pages fallback
         */
        $builder->connect('/pages/*', 'Pages::display');

        /**
         * General fallback
         * /tenders
         * /tenders/view/1
         * /tender-applications/add/3
         */
        $builder->fallbacks();
    });
};


