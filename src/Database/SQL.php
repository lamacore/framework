<?php

namespace Lama\Database;

use \Database\Connectors\ConnectionFactory;
use \Lama\Storage\Life;

class SQL {
    public static function getInstance()
    {
        if(Life::has('APP_DATABASE')) {
            return Life::get('APP_DATABASE');
        }

        $config = Life::get('APP_CONFIG_DATABASE');
        $factory = new ConnectionFactory();
        $instance = $factory->make($config);
        
        Life::set('APP_DATABASE', $instance);

        return $instance;
    }
}