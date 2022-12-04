<?php

namespace Lama;

use \Lama\Storage\Life;

class Application {
    public function __construct()
    {
        Life::set('REQUEST_URI', '/' . trim(explode('?', $_SERVER['REQUEST_URI'])[0], '/'));
        Life::set('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
    }
}