<?php

namespace Lama\Events;

class Trigger {
    private $triggers = [];

    public function on($event, $callback) {
        $this->triggers[$event] = $callback;
    }

    public function call($event) {
        if(isset($this->triggers[$event])) {
            return call_user_func($this->triggers[$event]);
        }
        return null;
    }
}