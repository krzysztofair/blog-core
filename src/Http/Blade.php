<?php

namespace Blog\Http;

use Philo\Blade\Blade as BladeEngine;

class Blade
{
    protected $blade;

    public function __construct()
    {
        $views = views_path();
        $cache = cache_path('');

        $this->blade = new BladeEngine($views, $cache);
    }

    public function compile($file, $args = [])
    {
        return $this->blade->view()->make($file, $args)->render();
    }
}