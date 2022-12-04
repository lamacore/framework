<?php

namespace Lama\Router\Providers;

use \Lama\Storage\Life;

class Basic {
    public static function handle($target)
    {
        $response = NULL;

        if(!Life::has('LAMA_RESPONSE')) {
            $response = new \Lama\Router\Providers\Http\Response();
            
            Life::set('LAMA_RESPONSE', $response);
        } else {
            $response = Life::get('LAMA_RESPONSE');
        }

        if(is_callable($target)) {
            return call_user_func_array($target, [$response]);
        }

        return NULL;
    }
}