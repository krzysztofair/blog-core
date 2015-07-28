<?php

namespace Blog\Parsers;

use Parsedown;

class Markdown implements Parser
{
    protected $parsedown;

    public function __construct(Parsedown $parsedown)
    {
        $this->parsedown = $parsedown;
    }

    public function parse($contents)
    {
        return $this->parsedown->text((string)$contents);
    }
}