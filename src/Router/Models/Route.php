<?php

namespace Lama\Router\Models;

use \Lama\Router\Providers\Basic as BasicProvider;
use \Lama\Storage\Life;

class Route {
    public $before = [];
    private $route;
    private $callback;
    private $method = 'GET';

    public function __construct($route, $callback, $method='GET') {
        $this->route = $route;
        $this->callback = $callback;
        $this->method = $method;
    }

    public function is()
    {
        return ($this->method == Life::get('REQUEST_METHOD') && $this->route == Life::get('REQUEST_URI'));
    }

    public function before($callback)
    {
        $this->before[] = $callback;
    }

    public function run()
    {
        foreach($this->before as $middleware) {
            if(BasicProvider::handle($middleware) != NULL) {
                return;
            }
        }
        
        BasicProvider::handle($this->callback);
    }
}