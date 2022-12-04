<?php

namespace Lama\Router;

use \Lama\Storage\Life;
use \Lama\Router\Models\Route;
use \Lama\Router\Providers\Basic as BasicProvider;

class Router {
    private $routes = [];
    private $notfound = NULL;

    public static function getInstance()
    {
        if(Life::has('APP_ROUTER')) {
            return Life::get('APP_ROUTER');
        }

        $instance = new self();
        
        Life::set('APP_ROUTER', $instance);

        return $instance;
    }

    public function set404($route, $callback) {
        $this->notfound = $callback;
    }

    public function get($route, $callback) {
        $this->routes[] = new Route($route, $callback, 'GET');
    }

    public function post($route, $callback) {
        $this->routes[] = new Route($route, $callback, 'POST');
    }
    
    public function run() {
        $invoked = 0;

        foreach($this->routes as $route) {
            if($route->is()) {
                $route->run();
                $invoked++;
            }
        }

        if($invoked == 0 && $this->notfound != NULL) {
            BasicProvider::handle($this->notfound);
        }
    }
}