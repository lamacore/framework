<?php

namespace Lama\Crypt;

class Key {
    public static function dump($params)
    {
        ob_start();
        var_dump($params);
        return ob_get_clean();
    }

    public static function make($params)
    {
        return md5(self::dump($params));
    }
}