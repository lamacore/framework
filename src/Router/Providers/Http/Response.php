<?php

namespace Lama\Router\Providers\Http;

use \Lama\Storage\Life;

class Response {
    public function send($data) {
        echo $data;
        return $this;
    }

    public function header($header)
    {
        if(!headers_sent()) {
            header($header);
        }
        return $this;
    }

    public function json($data=[]) {
        return $this->header('Content-Type: application/json')->send(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
    }

    public function render($filename, $data=[]) {
        $twig = NULL;
        if(!Life::has('TWIG_INSTANCE')) {
            $config = Life::get('APP_CONFIG_VIEWS');
            $loader = new \Twig\Loader\FilesystemLoader($config['directory']);

            $twig = new \Twig\Environment($loader, [
                'cache' => false
            ]);

            $twig->addFunction(new \Twig\TwigFunction('life', function($key) {
                return Life::get($key);
            }));

            Life::set('TWIG_INSTANCE', $twig);
        } else {
            $twig = Life::get('TWIG_INSTANCE');
        }

        return $this->send($twig->render($filename, $data));
    }

    public function end()
    {
        return true;
    }
}