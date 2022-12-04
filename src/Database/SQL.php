<?php

namespace Lama\Database;

use \Medoo\Medoo;
use \Lama\Storage\Life;

class SQL {
    public static function getInstance()
    {
        if(Life::has('APP_DATABASE')) {
            return Life::get('APP_DATABASE');
        }

        $config = Life::get('APP_CONFIG_DATABASE');
        $instance = new Medoo($config);
        
        Life::set('APP_DATABASE', $instance);

        return $instance;
    }
}