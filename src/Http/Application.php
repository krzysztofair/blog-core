<?php

namespace Blog\Http;

use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;

class Application extends Container
{
    protected $router;

    public function __construct()
    {
        $this['dispatcher'] = function($container) {
            return new Dispatcher;
        };

        $this['router'] = function($container) {
            return new Router($container['dispatcher'], $container);
        };

        $this->router = $this['router'];
    }

    public function start()
    {
        require __DIR__ . '/../routes.php';

        try
        {
            $request = Request::createFromGlobals();

            $response = $this->router->dispatch($request);

            $response->send();

        } catch(\Exception $e)
        {
            header("Location: " . $e->getMessage());
            exit;
        }
    }
}
