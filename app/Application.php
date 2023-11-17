<?php

declare(strict_types=1);

namespace App;

use App\Api\Binance;
use App\Models\CoinPairCollection;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use FastRoute;

class Application
{
    public function run(): void
    {
//        while (true) {
//            echo "enter coin pair\n";
//            $choice = readline();
//            if (strlen($choice) <= 3) {
//                $choice = strtoupper($choice) . 'BTC';
//            }
//            echo ($this->pairCollection->get(strtoupper($choice))) ?? 'No such coin';
//            echo "\n";
//
//        }

        $loader = new FilesystemLoader(__DIR__ . '/../app/Views');
        $twig = new Environment($loader, ['debug' => true]);
        $twig->addExtension(new DebugExtension());
        {
            $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
                $router->addRoute('GET', '/search', ['App\Controllers\CoinPairController', 'search']);
                $router->addRoute('GET', '/', ['App\Controllers\CoinPairController', 'index']);
            });

// Fetch method and URI from somewhere
            $httpMethod = $_SERVER['REQUEST_METHOD'];
            $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
            if (false !== $pos = strpos($uri, '?')) {
                $uri = substr($uri, 0, $pos);
            }
            $uri = rawurldecode($uri);

            $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
            switch ($routeInfo[0]) {
                case FastRoute\Dispatcher::NOT_FOUND:
                    // ... 404 Not Found
                    break;
                case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                    $allowedMethods = $routeInfo[1];
                    // ... 405 Method Not Allowed
                    break;
                case FastRoute\Dispatcher::FOUND:
                    $handler = $routeInfo[1];
                    $vars = $routeInfo[2];
                    [$className, $method] = $handler;


                    $response = (new $className())->{$method}($vars);

                    echo $twig->render($response->view() . ".html.twig", $response->CoinPairs());


                    break;
            }
        }
    }
}