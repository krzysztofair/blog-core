<?php

namespace Blog\Parsers;

interface Parser
{
    public function parse($path);
}