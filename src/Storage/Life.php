<?php

namespace Lama\Storage;

use \Lama\Crypt\Key;

class Life {
    private static $data = [];

    public static function has($name) {
        return isset(self::$data[Key::make($name)]);
    }

    public static function get($name) {
        $key = Key::make($name);

        if(!self::has($name)) {
            return null;
        }

        return self::$data[$key];
    }

    public static function set($name, $value) {
        $key = Key::make($name);

        self::$data[$key] = $value;

        return $value;
    }
}