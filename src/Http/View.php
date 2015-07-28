<?php

namespace Blog\Http;

class View
{
    protected $content = '';

    function __construct($app, $filename, $args = [])
    {
        $this->content = $app->make('Blog\\Http\\Blade')->compile($filename, $args);
    }

    public function __toString()
    {
        return $this->content;
    }
}
