<?php
/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 */
/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    // Register scoped middleware for in scopes.
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httponly' => true,
    ]));

    /*
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered through `Application::routes()` with `registerMiddleware()`
     */
    $builder->applyMiddleware('csrf');

    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, templates/Pages/home.php)...
     */
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'index']);
    $builder->connect('/home', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /*
     * Admin
     */
    $builder->connect('/admin/messages/is-new-message', ['controller' => 'Messages', 'action' => 'isNewMessage']);

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    $builder->connect('/chat-log-warehouses/dl-all-data', ['controller' => 'ChatLogWarehouses', 'action' => 'dlAllData']);

    $builder->connect('/private/logstorage/{filename}', ['controller' => 'Private', 'action' => 'logstorage'])
        ->setPass(['filename']);

    $builder->connect('/chat/chat-log-window/{chatRoomId}/{openLogWindow}', ['controller' => 'Chat', 'action' => 'chatLogWindow'])
        ->setPatterns(['chatRoomId' => '\d+'])
        ->setPatterns(['openLogWindow' => '\d+'])
        ->setPass(['chatRoomId', 'openLogWindow']);
    $builder->connect('/chat/{chatRoomId}', ['controller' => 'Chat', 'action' => 'index'])
        ->setPatterns(['chatRoomId' => '\d+'])
        ->setPass(['chatRoomId']);

    $builder->connect('/{controller}/{action}/{chatRoomId}/{chatEntryKey}')
        ->setPatterns(['chatRoomId' => '\d+'])
        ->setPass(['chatRoomId', 'chatEntryKey']);
    $builder->connect('/{controller}/{action}/{chatRoomId}')
        ->setPatterns(['chatRoomId' => '\d+'])
        ->setPass(['chatRoomId']);

    /*
     * Connect catchall routes for all controllers.
     *
     * The `fallbacks` method is a shortcut for
     *
     * ```
     * $builder->connect('/:controller', ['action' => 'index']);
     * $builder->connect('/:controller/:action/*', []);
     * ```
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/*
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * $routes->scope('/api', function (RouteBuilder $builder) {
 *     // No $builder->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
$routes->prefix('Admin', function (RouteBuilder $routes) {
    // ここのすべてのルートには、 `/admin` というプレフィックスが付きます。
    // また、 `'prefix' => 'Admin'` ルート要素が追加されます。
    // これは、これらのルートのURLを生成するときに必要になります
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'index']);
    $routes->fallbacks(DashedRoute::class);
});
